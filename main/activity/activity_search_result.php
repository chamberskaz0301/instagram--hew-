<?php
require('../../functions.php');

session_start();
require('../../dbconnect.php');

if(!empty($_POST['user_serch'])){

  $serch = "%".$_POST['user_serch']."%";



  $members = $db->prepare('SELECT * FROM posts where user_name like ? and not ?=id');


  $members->execute(array($serch,$_SESSION['id']));
  $member = $members->fetchAll();

}

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
        
        <?php if(!empty($member)):?>
          <?php foreach ($member as $user): ?>
              ユーザー名:
                <tr><td>
                  <a href="../user/another_user.php?id=<?php echo $user['id']?>"><?php echo $user[1]?></a>
                </td></tr>
                <br>
            <?php endforeach; ?>
          <?php else:?>

            <?php echo '検索ユーザーは該当しません。'; ?>
            

          <?php endif; ?>



          <form action="" method="post">

          <div>
            <div class="btn-border-gradient-wrap1">
                <a href="activity_search.php" class="btn btn-border-gradient">戻る</a>
            </div>
          </div>


          <div>
            <div class="btn-border-gradient-wrap">
                <a href="../index.php" class="btn btn-border-gradient">TOP</a>
            </div>
          </div>
          </form>

        </div>

    
  </body>

</html>