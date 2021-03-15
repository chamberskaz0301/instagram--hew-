<?php
require('../../functions.php');

session_start();
require('../../dbconnect.php');
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()){

  $_SESSION['time'] = time();

  $members = $db->prepare('SELECT * FROM posts where id = ?');
  $members->execute(array($_SESSION['id']));
  $member = $members->fetch();

}else{
  header('Location: ../login.php');
}

?>

<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>Instagram</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">

  </head>

  <body>
    <div id="wrap">
      <h1>Instagram</h1>
        <div>
            <div class="btn-border-gradient-wrap2">
                <a href="shop.php" class="btn btn-border-gradient">ショップ</a>
            </div>
        </div>

        <br>
        <div>
            <div class="btn-border-gradient-wrap3">
                <a href="food.php" class="btn btn-border-gradient">フード</a>
            </div>
        </div>

        <br>
        <div>
            <div class="btn-border-gradient-wrap">
                <a href="../index.php" class="btn btn-border-gradient">TOP</a>
            </div>
        </div>

    </div>
    
  </body>

</html>