
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php echo $member['picture'];?>
    <img src="../../story_picture/<?php echo hsc($member['picture']);?>" alt="">

</body>
</html>

<?php echo $member['picture'];?>

        <img src="../../story_picture/<?php echo hsc($member['picture']);?>" alt=""> -




       
        <?php if(file_exists("../../story_picture/" $member['picture'] === true);?>
        <img src="../../story_picure"<?php echo $member['picture'];?>
        <?php
            else:
            echo "画像は削除されました";
        ?>
        <?php 
          endif;
        ?>


     

<?php if(file_exists("../../story_picture/"$member['picture'] === true):?>
        <img src="../../story_picure"<?php echo $member['picture'];?>>
        <?php
            else:
            echo "画像は削除されました";
        ?>
        <?php 
          endif;
        ?>