<?php
require('../../functions.php');

session_start();
require('../../dbconnect.php');

if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()){

  $_SESSION['time'] = time();

}else{
  header('Location: ../../login.php'); 
}


if(!empty($_POST)){
  
  try{

    $check = $db->prepare('SELECT Count(*) as count From follow_req where post_id=? and follower_id=?');
    $check->execute(array($_SESSION['id'],$_POST['id']));
    $checks = $check->fetch();


 
    if($checks['count']==0){

      
       $follow = $db->prepare('INSERT INTO follow_req set post_id=?,follower_id=?');
       $follow->execute(array($_SESSION['id'],$_POST['id']));
       $follows = $follow->fetch();


     

    }else{
      header('Location: ./another_user.php?id='.$_POST['id'] . '&error=already');
      exit();

    }

  }catch(PDOException $e){  
          echo '失敗しました';
       }
    
    
    
   

  header('Location: ./another_user.php?id='.$_POST['id']);
  exit();
}





?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../../css/style.css">


</head>
<body>
  <div id="wrap">
    <title>フォローリクエスト</title> 
      <h1>
      Instagram
      </h1>
      <h2>フォローリクエスト</h2>

  </div>




  
  <div>
    <div class="btn-border-gradient-wrap1">
        <a href="./another_user.php?id=<?php echo $_POST['id'];?>" class="btn btn-border-gradient">戻る</a>
    </div>
    <div class="btn-border-gradient-wrap">
        <a href="../index.php" class="btn btn-border-gradient">TOP</a>
    </div>
  </div>
</body>
</html>