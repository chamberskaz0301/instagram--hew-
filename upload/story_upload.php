<?php
session_start();
require('../functions.php');

require('../dbconnect.php');

print_r($_FILES);
if(!empty($_FILES)){

    $fileName = $_FILES['image_path']['name'];
    if(!empty($fileName)){
        $ext = substr($fileName, -3);

        if($ext != 'jpg' && $ext != 'gif' && $ext != 'png'){
            $error['image'] = 'type';
        }
    }

    print_r($error);


    if(empty($error)){


       
        $image = date('YmdHis') . $_FILES['image_path']['name'];
        
        move_uploaded_file($_FILES['image_path']['tmp_name'],'story_picture/' . $image);
 

       

        $_SESSION['join']['image'] = $image;
        print_r($_SESSION);

        header('Location: story_check.php'); 

        exit();
     }

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ストーリー投稿サイト</title>
</head>
<body>
    <h1>ストーリー投稿サイト</h1>

    <form action="" method="post" enctype="multipart/form-data">
    <dl>
      

        <dt>写真</dt>
        <dd>
            <input type="file" name="image_path" size="35">

  
        </dd>
         
        
    </dl>

    <input type="submit" value="送信">

    </form>
    
</body>
</html>