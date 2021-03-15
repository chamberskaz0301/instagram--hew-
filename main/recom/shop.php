<?php
session_start();
require('../../dbconnect.php');
require('../../functions.php');

$shop_pictures = $db->prepare('SELECT * FROM shop');

$shop_pictures->execute();
$shops = $shop_pictures->fetchAll();


?>


<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>ショップ</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">

  </head>

  <body>
    <div id="wrap">
      <h1>Instagram</h1>
      <h2>ショップ</h2>

      <?php $imagepath ='../../upload/shop_picture/'; ?>


      <table class="recom">
      <tr>

        <?php 

          $i = 0;
          foreach($shops as $shop):
            $image = $imagepath.$shop['picture'];
            $about = $shop['about'];
            $id=$shop['id'];

            if($i % 3  === 0){

              echo "<tr>";
            }
        ?>

        <td>
    
          <a href="shop_detail.php?id=<?php echo($id);?>"><img src='<?php echo $image?>' alt='<?php echo $about;?>' class='pic'></a>
          
          
        </td>
        

        <?php

          $i++;
          endforeach;

        ?>
      </tr>
    </table>
 
        <div>
            <div class="btn-border-gradient-wrap">
                <a href="../index.php" class="btn btn-border-gradient">TOP</a>
            </div>
        </div>
        <div>
            <div class="btn-border-gradient-wrap2">
                <a href="recom.php" class="btn btn-border-gradient">戻る</a>
            </div>
        </div>

    </div>
    
  </body>

</html>