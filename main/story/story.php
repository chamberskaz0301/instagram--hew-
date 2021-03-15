<?php
require('../../functions.php');
session_start();
require('../../dbconnect.php');

$return_flag = true;

$id;
if (isset($_GET['image_id'])) {
  $id = $_GET['image_id'] + 1;
} else {
  $id = 1;
}

if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()){

  $_SESSION['time'] = time();
  $members = $db->prepare('SELECT * FROM story where id=?');
  $members->execute(array($id));
  $member = $members->fetch();

}else{
  header('Location: ../../login.php');
}

?>

<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>ストーリーズ</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">

    <script language="JavaScript">
          
    //指定のページに移動
    function loc() {
      window.location = "story.php?image_id=<?php echo $id;?>"
    }
     //タイマーをセット
     setTimeout(loc,2000);
    
  
  </script>

  </head>

  <body id="story">
    <div id="wrap">
        <h1>Instagram</h1>
        <h2>ストーリーズ</h2>

        <?php $imagepath ='../../upload/story_picture/';?>
        <?php if(!empty($member) > 0):?>
        

          <!--もし指定したファイルがあれば -->
          <?php if(file_exists($imagepath.$member['picture']) === true):?>
          <?php $flag = true; ?>
          <!--画像を表示 -->
          <img src="<?php echo $imagepath.$member['picture'];?>" alt="">
          <!-- もしなければ -->
          <?php else : ?>
          <!--no imageを表示 -->
          <?php $flag = false; ?>
          <img src="<?php echo $imagepath.'noimage.jpg';?>">
          <?php endif; ?>

          <?php else : ?>

          <img src="<?php echo $imagepath.'nomore.jpg';?>">
          <?php $flag = false; ?>

          <?php if($return_flag === true):?>
          <img src="<?php echo $imagepath.'nomore.jpg';?>">
          <?php $flag = false; ?> 
          <?php header('Location: ../index.php'); ?>
          <?php endif; ?>
        

          <?php endif; ?>


        <br>
        <div class="btn-border-gradient-wrap">
        <a href="../index.php" class="btn btn-border-gradient">TOP</a>
        </div>  
       
       

        <?php if ($flag === true):?>
          <div class="btn-border-gradient-wrap2">

            <!-- <input type="submit" name="next" value="次へ" class="btn btn-border-gradient" id="btn_cance"> -->
          <a href="story.php?image_id=<?php echo $id; ?>">次へ</a>
          </div>
        <?php endif; ?>
        </div>


    </div>
    
  </body>

</html>