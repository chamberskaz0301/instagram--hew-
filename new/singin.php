<?php
// ini_set('display_errors', 0);

session_start();
require('../dbconnect.php');
require('../functions.php');
if (!empty($_POST)){

  if($_POST['username'] == ''){
    $error['username'] = 'blank';
  }
  if($_POST['mail'] == '' && $_POST['phone_num'] == ''){
    $error['mail'] = 'blank' && $_POST['phone_num'] = 'blank';
  }
  if($_POST['password'] ==  ''){
    $error['password'] ='blank';
  }
  if($_POST['password_check'] ==  ''){
    $error['password_check'] ='blank';
  }
  if($_POST['password'] != $_POST['password_check']){
    $error['password'] ='diffrent';
  }

  $fileName = $_FILES['image_path']['name'];
  if(!empty($fileName)){
      $ext = substr($fileName, -3);

      if($ext != 'jpg' && $ext != 'gif' && $ext != 'png'){
          $error['image'] = 'type';
      }
  }
  

  if(empty($error)){

       
    $image = date('YmdHis') . $_FILES['image_path']['name'];
    
    move_uploaded_file($_FILES['image_path']['tmp_name'],'member_picture/' . $image);


    $_SESSION['join'] = $_POST;       
    $_SESSION['join'] ['username']= $_POST['username'];       
    $_SESSION['join'] ['mail']= $_POST['mail'];       
    $_SESSION['join']['image'] = $image;


    header('Location: account_check.php'); 

    exit();
 }

}


?>

<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>新規登録画面</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">

  </head>

  <body>
    <div id="wrap">
      <h1>Instagram</h1>
      <h2>新規登録画面</h2>
      <form action="" method="post" enctype="multipart/form-data">

          <label>メールアドレス</label> 
          <input type="text" size="35" name="mail" placeholder="メールアドレス">
          <br>
          <label>電話番号</label>          
          <input type="text" size="35" name="phone_num" placeholder="電話番号">
      
          <br>
          <label>ユーザー名</label> 
          <input type="text" name="username" size="35" placeholder="ユーザー名" 
          value="<?php echo isset($_POST['username']) > 0 ? $_POST['username'] :''; ?>" />

          <br>
          <label>写真</label>
          <input type="file" name="image_path" size="35" />

 
          <br>
          <label>パスワード</label>
          <input type="password" name="password" placeholder="パスワード">
          <br>
          <label>上記と同じパスワード </label>
          <input type="password" name="password_check" placeholder="パスワード">

          <input type="submit" name="singin" value="登録">

      </form>
    </div>
  </body>

</html>


