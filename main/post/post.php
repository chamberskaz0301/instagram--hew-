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

    <title>投稿画面</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">

  </head>

  <body>
    <div  id="wrap">
      <h1>Instagram</h1>
      <h2>投稿画面</h2>

      <table class="top">

        <tr>
            <td>
                <a href="post_album.php" class="circle">アルバム</a>
            </td>
            <td>
                <a href="post_camera.php" class="circle">カメラ</a>
            </td>
 
        </tr>
        </table>

      
 
    
        <div class="btn-border-gradient-wrap2">
            <a href="../index.php" class="btn btn-border-gradient">TOP</a>
        </div>

      
    </div>
    
  </body>

</html>