<?php



require('../../functions.php');

session_start();
require('../../dbconnect.php');

if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()){

  $_SESSION['time'] = time();

}else{
  header('Location: ../../login.php'); 
}





  try{
    
    
    $follow_check = $db->prepare('SELECT follow_req.post_id, follow_req.follower_id,posts.id,posts.user_name FROM follow_req
    INNER JOIN posts ON follow_req.post_id=posts.id where follow_req.follower_id = ?;');
    $follow_check->execute(array($_SESSION['id']));
    $follow_checks = $follow_check->fetchAll();



  }catch(PDOException $e){  
    echo '失敗しました';
  }  

?>
 


<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>フォローリクエスト</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">

  </head>

  <body>
    <div id="wrap">
        <h1>Instagram</h1>
        <h2>フォローリクエスト</h2>

        <?php 

          $i = 0;
          foreach($follow_checks as $follow_freind):

            if($i % 1  === 0){
              echo "
                <form action='follow_apply.php' method='post'>
                  <input type='text' name='user_name' value='".$follow_freind['user_name']."' readonly='readonly'>
                  <input type=\"hidden\" name=\"user_id\" value=${follow_freind['id']}>
                  <select name='apply'>
                    <option value='yes'>承認する</option>
                    <option value='no'>承認しない</option>
                  </select>
                  <input type='submit' value='送信'>
                </form>
              \n";
            }
        ?>



      

        <?php

        $i++;
        endforeach;

        ?>
        
        <div>
          <div class="btn-border-gradient-wrap">
              <a href="../index.php" class="btn btn-border-gradient">TOP</a>
          </div>
        </div>
        
        <div>
          <div class="btn-border-gradient-wrap2">
              <a href="activity.php" class="btn btn-border-gradient">戻る</a>
          </div>
        </div>
        
      </div>

    
  </body>

</html>