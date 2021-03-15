<?php
require('../../functions.php');

session_start();
require('../../dbconnect.php');
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()){

  $_SESSION['time'] = time();



//   SELECT follow.follower_id,posts.user_name FROM follow
//   LEFT OUTER JOIN posts on  follow.followed_id=posts.id


  $members = $db->prepare('SELECT DISTINCT follow.followed_id,posts.user_name FROM follow
  LEFT OUTER JOIN posts on  follow.followed_id=posts.id WHERE posts.id not in (?) ');
  $members->execute(array($_SESSION['id']));
  $member = $members->fetchAll();


}else{
  header('Location: ../login.php');
}

?>


<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>フォロワー画面</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">

  </head>

  <body>
    <div id="wrap">
      <h1>フォロワー一覧画面</h1>


      <?php $i = 0; ?>

      <?php if(!empty($member)):?>
      
        <?php foreach($member as $follow):?>


            フォロワー名：
          <tr><td>


          <a href="follow_user.php?id=<?php echo $follow['followed_id']?>"><?php echo $follow['user_name']?></a>
          </tr></td>
          <br>


      


        <?php endforeach; ?>
      
      <?php else:?>
        
        <?php echo 'フォロワーはいません。';?>

      <?php endif; ?>

  
        <br>
        <div>
            <div class="btn-border-gradient-wrap">
                <a href="../index.php" class="btn btn-border-gradient">TOP</a>
            </div>
        </div>

        <div class="btn-border-gradient-wrap2">
          <a href="activity.php" class="btn btn-border-gradient">戻る</a>
        </div>

    </div>
    
  </body>

</html>