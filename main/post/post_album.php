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

    <title>アルバム</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">

  </head>

  <body>
    <div  id="wrap">
      <h1>Instagram</h1>
      <h2>アルバム</h2>

      <h3>モザイク挿入</h3>

    <form action="./album_upload.php" method="post" enctype="multipart/form-data">

      <script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous">
      </script>

      <script type="text/javascript" src="mozaiku.js"></script>

      <input id="file" type="file">
      <br><br>
      <p>1~8の数字をどれかを選んでください。</p>
      <input id="mosaic" type="button" value="モザイク挿入">
      mosaic width:
      <select id="mosaic-width">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4" selected>4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
      </select>px&nbsp;&nbsp;
      mosaic height:
      <select id="mosaic-height">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4" selected>4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
      </select>px
      <br><br>
      <div id="left-area">
      before<br>
        <canvas id="src-canvas"></canvas>
      </div>
      <div>
      after<br>
        <canvas id="dst-canvas"></canvas>
      </div>

      <button id="button">投稿</button>
      


    </form>


  <div>
          <div class="btn-border-gradient-wrap">
              <a href="../index.php" class="btn btn-border-gradient">TOP</a>
          </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script>
          const element = document.querySelector("#button");
          button.addEventListener("click", async (event) => {
            event.preventDefault();
            const canvas = document.querySelector("#dst-canvas");
            const form = document.querySelector("form");
            const album = canvas.toDataURL("image/png");
            try {
              //値を渡すために必要なクラスをインスタンス化
              let params = new URLSearchParams();
              //引数を与えた
              params.append('album', album);
              // ~.phpにPOST通信でデータを渡す
              const response = await axios.post("album.php", params);
              location.href='post_list.php';
            } catch (error) {
              alert(error);
            }
          })
        </script>
      </body>
</html>