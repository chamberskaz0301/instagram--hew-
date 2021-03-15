<?php
ini_set('display_errors', 0);

session_start();
require('../../dbconnect.php');
require('../../functions.php');

$id = $_REQUEST['id'];
if(!is_numeric($id) || $id <= 0) {
  print('入力する値を数字にしてね！1以上しか入力できません！');
  
  exit();
}



$food_pictures = $db->prepare('SELECT * FROM food where id=?');

$food_pictures->execute(array(
  $_GET['id']
));
$foods = $food_pictures->fetch();


?>

<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>詳細画面</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">

  </head>

  <body>

    <div id="wrap">
        <h1>Instagram</h1>
        <h2>フード</h2>

        <p class='food'><?php echo $foods['about']; ?></p>

        <img src='../../upload/food_picture/<?php echo $foods['picture']?>' alt='<?php echo $foods['about'];?>'>
        
        <p>外部のWEBサイトに飛びます<br>
        よろしければ下記のリンクを<br>
        クリックして下さい。
        </p>
        <a href="<?php echo $foods['url'];?>" target="__blank"><?php echo $foods['url'];?></a>


        <div>
            <div class="btn-border-gradient-wrap">
                <a href="../index.php" class="btn btn-border-gradient">TOP</a>
            </div>
        </div>

        <div>
            <div class="btn-border-gradient-wrap2">
                <a href="food.php" class="btn btn-border-gradient">戻る</a>
            </div>
        </div>
    
        </div>

    
    
  </body>

</html>