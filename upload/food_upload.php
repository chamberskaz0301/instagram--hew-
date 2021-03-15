<?php
session_start();
require('../functions.php');

require('../dbconnect.php');

if(!empty($_POST)){
    if($_POST['message'] == ''){
        $error['message'] = 'blank';
    }

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
        
        move_uploaded_file($_FILES['image_path']['tmp_name'],'food_picture/' . $image);
 

        $_SESSION['join'] = $_POST;       
        $_SESSION['join']['message'] = $_POST['message'];
        $_SESSION['join']['image'] = $image;
        $_SESSION['join']['url'] = $_POST['url'];

        print_r($_SESSION);

        header('Location: food_check.php'); 

        exit();
     }

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>フード投稿サイト</title>
</head>
<body>
    <h1>フード投稿サイト</h1>

    <form action="" method="post" enctype="multipart/form-data">
    <dl>
    <dt>説明を入力してください。</dt>
        <dd>
            <textarea name="message"  cols="30" rows="10" placeholder='メッセージを入力してください。'></textarea>
        </dd>     

        <dt>写真</dt>
        <dd>
            <input type="file" name="image_path" size="35">

  
        </dd>

        <h2>URL</h2>
        <div>
        <textarea name="url"  cols="30" rows="10" placeholder='URLを入力してください。'></textarea>

        </div>
         
         
        
    </dl>

    <input type="submit" value="送信">

    </form>
    
</body>
</html>