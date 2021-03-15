<?php
require('../../functions.php');

session_start();
require('../../dbconnect.php');
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()){

  $_SESSION['time'] = time();

}else{
  header('Location: ../../login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/style.css">

    <title>アルバム投稿</title>
</head>
<div id="wrap">
  <body>
  <h1>INSTAGRAM</h1>

  <form action="post_album_edit.php" method="post">
      
      <?php
      $tempfile = $_FILES['file']['tmp_name'];
      $filename = './img/'.$_FILES['file']['name'];

      if (is_uploaded_file($tempfile)) {
          if (move_uploaded_file($tempfile, $filename)) {
              echo $filename . "をアップロードしました。";
          }
      }
      ?>
  <br>
  <input type="hidden" name="tempfile" value="<?php echo hsc($filename); ?>">
  <img src ="<?php echo hsc($filename); ?>"widrh="20" heigth ="20" alt="アルバム写真" /><br>
  <input type="submit" name="編集">

  </form>

  


  <a href="post_album.php">戻る</a>
    </div<>
  <br>

  <div>
            <div class="btn-border-gradient-wrap">
                <a href="../index.php" class="btn btn-border-gradient">TOP</a>
            </div>
  </div>

  </body>
</div>
</html>