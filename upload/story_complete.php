<?php
session_start();
require('../dbconnect.php');
require('../functions.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿</title>
</head>
<body>
    <h1>投稿</h1>

    <h2>登録完了</h2>
    
    <h2>登録した画像</h2>

   
    <div>
    <img src="story_picture/<?php echo hsc($_SESSION['join']['image']);?>"width="100" height="100" alt="<?php echo hsc($_SESSION['join']['image']);?>"/>
    </div>

    <form action="story_upload.php">
        <input type="submit" value="戻る">
    </form>

    
</body>
</html>