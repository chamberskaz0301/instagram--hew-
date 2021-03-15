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

    <title>カメラ編集画面</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">

  </head>

  <body>
    <div  id="wrap">
      <h1>Instagram</h1>
      <h2>編集画面</h2>

      <table class="post">

        <form action="post_camera_done.html" method="POST">

        <img src="camera/<?php echo hsc($_POST['image']); ?>" alt="撮影画像"><br>

        <?php?>


            <br>

            <input type="submit" name="post" value="投稿" class="button"> 

        </form>



            

    </div>
    
  </body>

</html>