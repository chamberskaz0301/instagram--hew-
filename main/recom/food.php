<?php
ini_set('display_errors', 0);

session_start();
require('../../dbconnect.php');
require('../../functions.php');



$food_pictures = $db->prepare('SELECT * FROM food');


$food_pictures->execute(array());
$foods = $food_pictures->fetchAll();


?>


<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>フード</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">


  </head>

  <body>
    <div id="wrap">
      <h1>Instagram</h1>
      <h2>フード</h2>

    <form action="food_detail.php" method="post">
 
      <table class="recom">
        
        <?php $imagepath ='../../upload/food_picture/'; ?>
        <tr>
        
          <?php 

            $i = 0;
            foreach($foods as $food):
              $image = $imagepath.$food['picture'];
              $about = $food['about'];
              $id=$food['id'];

              if($i % 3  === 0){

                echo "</tr><tr>";

              }
          ?>

          <td>
              
            <a href="food_detail.php?id=<?php echo($id);?>"><img src='<?php echo $image?>' alt='<?php echo $about;?>' class='pic'></a>

          </td>

          <?php
            $i++;
            endforeach;
          ?>
        </tr>
      </table>
   </form>
   
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