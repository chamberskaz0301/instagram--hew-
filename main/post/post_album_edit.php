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

<html>

  <head>

    <meta charset="utf-8">

    <title>アルバム編集画面</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">

  </head>

  <body>
    <div id="wrap">
      <h1>Instagram</h1>
      <h2>編集画面</h2>

      <table class="post">

        <form action="" method="POST">

        <?php print_r($_POST); ?>



        <img src ="<?php echo hsc($_POST["tempfile"]); ?>"widrh="20" heigth ="20" alt="アルバム写真" /><br>


    

            <input type="submit" name="post" value="投稿" class="button"> <br>

            <div class="btn-border-gradient-wrap">
              <a href="../index.php" class="btn btn-border-gradient">TOP</a>
            </div>

           

        </form>



            

    </div>
    
  </body>

</html>