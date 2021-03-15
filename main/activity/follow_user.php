<?php
require('../../functions.php');

session_start();
require('../../dbconnect.php');

if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()){

  $_SESSION['time'] = time();

}else{
  header('Location: ../../login.php'); 
}

$id = $_REQUEST['id'];
if(!is_numeric($id) || $id <= 0) {
  print('入力する値を数字にしてね！1以上しか入力できません！');
  
  exit();
}

$members = $db->prepare('SELECT posts.id,posts.user_name, posts.profile, posts.picture FROM posts
LEFT OUTER JOIN follow on  posts.id=?');
$members->execute(array($_GET['id']));
$member = $members->fetch();




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
        <title>フォロワーページ</title> 
        <h1>
        Instagram
        </h1>
        <h2>フォロワーページ</h2>
        <?php echo $member['user_name'];?><br>

        <img src ="../../new/member_picture/<?php echo hsc($member['picture']); ?>"  alt="プロフィール写真" class="aikon" /><br>

        <?php echo $member['profile'];?>






            <div>
                <div class="btn-border-gradient-wrap2">
                    <a href="activity_follower.php" class="btn btn-border-gradient">戻る</a>
                </div>
                <div class="btn-border-gradient-wrap">
                    <a href="../index.php" class="btn btn-border-gradient">TOP</a>
                </div>
            </div>

    </div>  

</body>
</html>