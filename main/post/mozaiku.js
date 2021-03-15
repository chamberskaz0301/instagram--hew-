$(function() { Main.init(); });

var Main = (function() {
  var 
  _srcCtx,  // 変更前の画像を表示するCanvasのコンテキスト
  _dstCtx,  // 変更後の画像を表示するCanvasのコンテキスト
  
  // 初期化メソッド
  _init = function() {    
    _attachEvents();
  },
      
  // イベントハンドラ定義
  _attachEvents = function() {
    
    // ファイル変更時の処理
    $('#file').on('change', function(e) {
      _loadFile(e.target.files[0]) // ファイルを読み込む
      .then(_loadImage) // 画像をロードする
      .then(function(image) {
        _resizeCanvas(image.width, image.height);
        _srcCtx.drawImage(image, 0, 0);
        _dstCtx.clearRect(0, 0, _dstCtx.canvas.width, _dstCtx.canvas.height);
      });     
    });
    
    // モザイク処理ボタン押下時の処理
    $('#mosaic').click(function() {
      var mosaicWidth = parseInt($('#mosaic-width').val(), 10),
          mosaicHeight = parseInt($('#mosaic-height').val(), 10),
          srcImageData = _srcCtx.getImageData(0, 0, _srcCtx.canvas.width, _srcCtx.canvas.height),
          imageData;
          
      imageData = _mosaic(srcImageData, mosaicWidth, mosaicHeight);
      _dstCtx.clearRect(0, 0, _dstCtx.canvas.width, _dstCtx.canvas.height);
      _dstCtx.putImageData(imageData, 0, 0);
    });
  },
      
  _loadFile = function(file) {
    return new Promise(function(resolve, reject) {
      var reader = new FileReader();
      // dataURL形式でファイルを読み込む
      reader.readAsDataURL(file);      
      reader.onload = function() {
        resolve(reader.result);
      };
    });              
  },
      
  _loadImage = function(dataUrl) {
    return new Promise(function(resolve, reject) {
      var image = new Image();
      image.onload = function() {
        resolve(image);
      };
      image.src = dataUrl;
    });
  },  
      
  // canvasをリサイズする
  _resizeCanvas = function(width, height) {
    // canvasのサイズを変更する
    $('#src-canvas, #dst-canvas').prop({ 
      width: width, 
      height: height 
    });
    // コンテキストを取得しなおす
    _srcCtx = $('#src-canvas')[0].getContext('2d');    
    _dstCtx = $('#dst-canvas')[0].getContext('2d');
  },
      
  // imageData作成
  _createImageData = function(width, height) {
    var canvas = document.createElement('canvas'),
        ctx, imageData;
    canvas.width = width;
    canvas.height = height;
    ctx = canvas.getContext('2d');
    imageData = ctx.createImageData(width, height);
    return imageData;
  },
  
  // モザイク処理
  _mosaic = function(srcImageData, mosaicWidth, mosaicHeight) {
             
    var srcData = srcImageData.data,      
      imgWidth = srcImageData.width,
      imgHeight = srcImageData.height,
      imageData = _createImageData(imgWidth, imgHeight),
      data = imageData.data,
      x, w, y, h, r, g, b, pixelIndex, i, j, pixelCount;
         
    // モザイクサイズが m×n の場合、m×n毎に処理する
    for(x = 0; x < imgWidth; x += mosaicWidth) {
      if(mosaicWidth <= imgWidth - x) { w = mosaicWidth; }
      else                            { w = imgWidth - x; }

      for(y = 0; y < imgHeight; y += mosaicHeight) {
        if(mosaicHeight <= imgHeight - y) { h = mosaicHeight; }
        else                              { h = imgHeight - y; }

        // モザイクの色を計算する
        r = g = b = 0;
        for(i = 0; i < w; i += 1) {
          for(j = 0; j < h; j += 1) {
            pixelIndex = ((y + j) * imgWidth + (x + i)) * 4; // ピクセルのインデックスを取得
            r += srcData[pixelIndex];
            g += srcData[pixelIndex + 1];
            b += srcData[pixelIndex + 2];
          }
        }

        // 平均を取る
        pixelCount = w * h; // モザイクのピクセル数            
        r = Math.round(r / pixelCount);
        g = Math.round(g / pixelCount);
        b = Math.round(b / pixelCount);

        // モザイクをかける            
        for(i = 0; i < w ;i += 1) {
          for(j = 0; j < h; j += 1) {
            pixelIndex = ((y + j) * imgWidth + (x + i)) * 4; // ピクセルのインデックスを取得
            data[pixelIndex] = r;
            data[pixelIndex + 1] = g;
            data[pixelIndex + 2] = b;
            data[pixelIndex + 3] = srcData[pixelIndex + 3]; // アルファ値はそのままコピー
          }
        }
      }
    }
    
    return imageData;
  };
  
  // _initメソッドのみを公開する
  return {
    init: _init 
  };
  
}());