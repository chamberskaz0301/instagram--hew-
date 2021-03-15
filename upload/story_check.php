<?php
require('../dbconnect.php');
require('../functions.php');

session_start();


if(!isset($_SESSION['join']['image'])){
header('Location: story_upload.php');
exit();
}

if(!empty($_SESSION)){

    try{
        $statement = $db->prepare('INSERT INTO story SET picture=?');
        echo $ret = $statement->execute(array(
            $_SESSION['join']['image']

        ));

        header('Location: story_complete.php');
        exit();

    }catch(PDOException $e){
        $error = '失敗しました';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ストーリー投稿</title>
</head>
<body>
    <h1>投稿</h1>

    <form action="story_complete.php" method="post" enctype="multipart/form-date">
        <input type="hidden" name="action" value="submit" />
    <dl>


        <dt>写真</dt>
        <dd>
            <img src="story_picture/<?php echo hsc($_SESSION['join']['image']); ?>"
            width="100" height="100" alt="">
            
        </dd>
         
        
    </dl>

    <input type="submit" value="送信">

    </form>
    
</body>
</html>