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

    <title>アクティビティ画面</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">

  </head>

  <body>
    <div id="wrap">
      <h1>アクティビティ画面</h1>
        <div>
            <div class="btn-border-gradient-wrap2">
                <a href="./activity_search.php" class="btn btn-border-gradient">検索</a>
            </div>
        </div>

        <br>
        <div>
            <div class="btn-border-gradient-wrap3">
                <a href="./activity_follow.php" class="btn btn-border-gradient">フォローリクエスト</a>
            </div>
        </div>

        <br>

        <div>
            <div class="btn-border-gradient-wrap2">
                <a href="./activity_follower.php" class="btn btn-border-gradient">フォロワー一覧</a>
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