<?php
require('../../functions.php');

session_start();
require('../../dbconnect.php');

if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()){

  $_SESSION['time'] = time();

}else{
  header('Location: ../../login.php'); 
  exit();
}


if(!empty($_POST["apply"])){
    $apply = $_POST["apply"];

    echo $apply;
    
}else{
    header('Location:acyivity_follow.php'); 
    exit();
}




if($apply == 'yes'){


    $yes = $db->prepare('INSERT INTO follow set follower_id=?, followed_id=?');


    $yes->execute(array($_SESSION['id'],$_POST['user_id']));


    $yes = $db->prepare('INSERT INTO follow set follower_id=?, followed_id=?');


    $yes->execute(array($_POST['user_id'],$_SESSION['id']));



    $yes=$db->prepare('DELETE FROM follow_req WHERE post_id=? AND follower_id=?');



    $yes->execute(array($_POST['user_id'],$_SESSION['id']));
    
    header('Location:activity_follow.php');
    exit();

}else{
    $no=$db->prepare('DELETE FROM follow_req WHERE post_id=? AND follower_id=?');
    $no->execute(array($_POST['user_id'],$_SESSION['id']));
    header('Location:activity_follow.php');
    exit();

}

 






?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
  <pre>
  <?php echo($_POST['user_id']); ?>
  </pre>
</body>
</html>