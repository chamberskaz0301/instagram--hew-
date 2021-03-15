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
  header('Location: ../../login.php');
}

?>



<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>マイページ</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">

  </head>

  <body>
    <div id="wrap">
        <h1>Instagram</h1>
        <h2>MY PAGE</h2>
        <div>

        <dd>
            <img src ="../../new/member_picture/<?php echo hsc($member['picture']); ?>" class="pic" alt="プロフィール写真" />
        </dd>
        </div>
        <h2>
          <?php
         
            echo hsc($member['user_name']);
          ?>
        </h2>
        <p>自己紹介</p>
      <div>
        <p class="box">
          <?php echo($member['profile']); ?>
        </p>
      </div>
<!-- 
      <form action="follow_req.php" method="post">
        <input type="hidden" name="">
        <input type="submit" value="フォローリクエスト">

      </form> -->

      <div class="btn-border-gradient-wrap">
        <a href="../index.php" class="btn btn-border-gradient">TOP</a>
      </div>
      <div class="btn-border-gradient-wrap2">
        <a href="user_pro.php" class="btn btn-border-gradient">編集</a>
      </div>

      
    </div>
    
  </body>

</html>