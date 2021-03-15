<?php
ini_set('display_errors', 0);

require('../../functions.php');

session_start();
require('../../dbconnect.php');


?>


<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>ユーザー検索</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">

  </head>

  <body>
    <div id="wrap">
        <h1>Instagram</h1>
        <h2>ユーザー検索</h2>

        <form action="activity_search_result.php" method="post">

          ユーザー名:<input type="text" name="user_serch" placeholder="ユーザー名入力" value="<?php echo $_POST['id']?>">
       
          <br>
            <input type="submit">
        </form>




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