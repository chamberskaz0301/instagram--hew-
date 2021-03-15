<?php
require('../../functions.php');

session_start();
require('../../dbconnect.php');
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()){

  $_SESSION['time'] = time();

}else{
  header('Location: ../../login.php');
}

?>

<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>カメラ撮影</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <style>
      canvas, video{
        border: 1px solid gray;
      }
      </style>
  </head>

  <body>  
    <div  id="wrap">
      <h1>Instagram</h1>
      <h2>カメラ撮影</h2>
      
<video id="camera" width="300" height="200"></video>
<canvas id="picture" width="300" height="200"></canvas>
<form>
  <button type="button" id="shutter">撮影</button>
</form>

<audio id="se" preload="auto">
  <source src="camera-shutter1.mp3" type="audio/mp3">
</audio>

<script>
window.onload = () => {
  const video  = document.querySelector("#camera");
  const canvas = document.querySelector("#picture");
  const se     = document.querySelector('#se');

  /** カメラ設定 */
  const constraints = {
    audio: false,
    video: {
      width: 300,
      height: 200,
      facingMode: "user"   // フロントカメラを利用する
      // facingMode: { exact: "environment" }  // リアカメラを利用する場合
    }
  };

  /**
   * カメラを<video>と同期
   */
  navigator.mediaDevices.getUserMedia(constraints)
  .then( (stream) => {
    video.srcObject = stream;
    video.onloadedmetadata = (e) => {
      video.play();
    };
  })
  .catch( (err) => {
    console.log(err.name + ": " + err.message);
  });

  /**
   * シャッターボタン
   */
   document.querySelector("#shutter").addEventListener("click", async () => {
    const ctx = canvas.getContext("2d");

    // 演出的な目的で一度映像を止めてSEを再生する
    video.pause();  // 映像を停止
    se.play();      // シャッター音
    setTimeout( () => {
      video.play();    // 0.5秒後にカメラ再開
    }, 500);

    // canvasに画像を貼り付ける
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

      try {
      //データURLに変換
      const image = canvas.toDataURL("image/png");
      //値を渡すために必要なクラスをインスタンス化
      let params = new URLSearchParams();
      //引数を与えた
      params.append('image', image);
      //dowlnload.phpにPOST通信でデータを渡す
      const response = await axios.post("./download.php", params);


      // 不要な文字の削除
      let file = response.data.slice(2);
      file = file.slice(0, -1);



      if(response.data == false){
        alert("エラーが発生しました")
      }

      const form = document.querySelector("form");
      form.method = "POST";
      form.action = "./post_camera_edit.php";

      const hide = document.createElement("input");
      hide.type = "hidden";
      hide.name = "image";
      hide.value = file;
      form.appendChild(hide);

      form.submit();
    } catch (error) {
      alert(error);
    }
  });
};
</script>
      

      <div class="btn-border-gradient-wrap2">
          <a href="../index.php" class="btn btn-border-gradient">TOP</a>
      </div>

      
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  </body>

</html>

