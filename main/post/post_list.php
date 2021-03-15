<?php
require('../../functions.php');

session_start();
require('../../dbconnect.php');
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()){

  $_SESSION['time'] = time();

}else{
  header('Location: ../../login.php');
}

$stmt = $db->prepare('SELECT picture as album FROM album_edit');
$stmt->execute(array());
$albums = $stmt->fetchAll();

$stmt1 = $db->prepare('SELECT picture as camera FROM camera');
$stmt1->execute(array());
$cameras = $stmt1->fetchAll();

$posts = array_merge($albums, $cameras);

?>

<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>投稿一覧</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">

  </head>

  <body>
    <div  id="wrap">
      <h1>Instagram</h1>
      <h2>投稿一覧</h2>


    <?php $post_list ='album/';?>
    <?php $post_list1 ='camera/';?>
    
    <table class="recom"> 
        <tr>
        <?php $i = 0; ?>
        <?php foreach($posts as $post ): ?>

            <?php if($i % 3 === 0):?>
            </tr><tr>
            <?php endif;?>

        <!--もし指定したファイルがあれば -->
        <?php if(array_key_exists('album',$post)):?>

          <?php if(file_exists($post_list.$post['0']) === true):?>
        <!--画像を表示 -->
            <td>
              <img src="<?php echo $post_list.$post['0'];?>" alt="アルバム" class='pic'>
            </td>
          <?php endif; ?>

          <?php else:?>
            <?php if(file_exists($post_list1.$post['0']) === true):?>
          <!--画像を表示 -->
              <td>
                <img src="<?php echo $post_list1.$post['0'];?>" alt="カメラ" class='pic'>
              </td>
            <?php endif; ?>
          <?php endif; ?>

        <?php $i++; ?>
        
        <?php endforeach; ?>

        </tr>
    </table>

    <div>
        <div class="btn-border-gradient-wrap">
            <a href="../index.php" class="btn btn-border-gradient">TOP</a>
        </div>
    </div>


    </div>
    
  </body>

</html>