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

  

if(!empty($_POST)){


  if( sha1($_POST['password']) == $member['password']){

      if($_POST['profile'] != ''){
        $profile = $db->prepare('UPDATE posts SET user_name=? ,profile=? WHERE id=?;');
      
        $profile->execute(array($_POST['new_username'],$_POST['profile'],$_SESSION['id']));
          header('Location: user.php');
          exit();
      }

  }else{
    header('Location: user_pro.php');
  }

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
      <form action="" method="POST"  enctype="multipart/form-data">

        新しいユーザー名<input type="text" name="new_username" placeholder="新しいユーザー名"><br>
        新しい自己紹介<textarea name="profile" rows="10" cols="35" placeholder="ここに記入してください"></textarea><br>
        

        <p>下記にパスワードを入力して下さい。</p>
          パスワード<input type="password" name="password" placeholder="パスワード"><br>
        <div class="btn-border-gradient-wrap">          
          <input type="submit" name="OK" value="OK" class="btn btn-border-gradient">
        </div>
      </form>
        
        <div class="btn-border-gradient-wrap2">
            <a href="../index.php" class="btn btn-border-gradient">TOP</a>
        </div>
    
      
    </div>
    
  </body>

</html>