<?php
ini_set('display_errors', 0);
require('dbconnect.php');
require('functions.php');


session_start();

if($_COOKIE['username'] != ''){
  $_POST['username'] =$_COOKIE['username'];
  $_POST['password'] =$_COOKIE['password'];
  $_POST['save'] = 'on';
}



if (!empty($_POST)){

  if($_POST['username'] != '' && $_POST['password'] != ''){
    $login = $db->prepare('SELECT * FROM posts WHERE user_name=? AND password=?');
    $login->execute(array($_POST['username'],sha1($_POST['password'])));
    $member = $login->fetch();

    if($member){
      $_SESSION['id'] = $member['id'];
      $_SESSION['time'] = time();

    if($_POST['save'] == 'on'){
      setcookie('username', $_POST['username'], time()+60*60*24*14,'/');
      setcookie('password', $_POST['password'], time()+60*60*24*14, '/');
    }


      header('Location: main/index.php');
      exit();

    }else{
      $error['login'] = 'failed';
    }

  }else{
    $error['login'] = 'blank';
  }
}

?>
<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>Instagram</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">

  </head>

  <body>
    <div id="wrap">
      <h1>Instagram</h1>
      <form action="" method="POST">
          ユーザー名<input type="text" name="username"  placeholder="ユーザー名"><br>
          パスワード<input type="password" name="password" placeholder="パスワード"><br>

          <input type="submit" name="singin" value="ログイン">

      </form>
      <!-- <a href="reissue/reissue.html">パスワード忘れ</a> -->

      <a href="new/singin.php">新規登録</a>
      
    </div>
    
  </body>

</html>