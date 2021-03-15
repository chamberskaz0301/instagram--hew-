<?php
require('../../functions.php');

session_start();
require('../../dbconnect.php');
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()){

  $_SESSION['time'] = time();

}else{
  header('Location: ../../login.php');
}


$check = $db->prepare('SELECT Count(*) as count From follow where follower_id=? and followed_id=?');
$check->execute(array($_SESSION['id'],$_GET['id']));
$checks = $check->fetch();

$members = $db->prepare('SELECT * FROM posts where id=?');


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

    <title>ユーザーページ</title>
</head>
<body>
  <div id="wrap">
  <h1>Instagram</h1>

    <p>
    ユーザー名:
      <?php echo($member['user_name']);?><br>
      <img src ="../../new/member_picture/<?php echo hsc($member['picture']); ?>"  alt="プロフィール写真" class="aikon" /><br>
      自己紹介:
      <?php echo($member['profile']);?><br>

    </p>

    <?php
    if(isset($_GET['error'])&& $_GET['error']=='already'){

        echo '既に送信してます。';
    }
  
    ?>

    

     <?php  if($checks['count'] == 0):?>

      
      <form action='follow_req.php' method='post'>
       <input type='hidden' name='id' value= '<?php echo $member['id'];?>'>
       <input type='submit' value='フォローリクエスト'>
       </form>
       <?php else: echo('既にフォロー関係です');?>


    <?php endif; ?>  
    
    <div>
      <div class="btn-border-gradient-wrap2">
          <a href="../activity/activity_search.php" class="btn btn-border-gradient">戻る</a>
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