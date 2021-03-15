<?php
require('../dbconnect.php');
require('../functions.php');

session_start();


if(!isset($_SESSION['join'])){
header('Location: food_upload.php');
exit();
}

if(!empty($_POST)){

    try{
        $statement = $db->prepare('INSERT INTO food SET picture=?, about=?, url=?');
        echo $ret = $statement->execute(array(
            $_SESSION['join']['image'],
            $_SESSION['join']['message'],
            $_SESSION['join']['url']


        ));

        header('Location: food_complete.php');
        exit();

    }catch(PDOException $e){
        $error = '失敗しました';
        echo'失敗';
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

    <form action="" method="post" enctype="multipart/form-date">
        <input type="hidden" name="action" value="submit" />
    <dl>
    <dt>メッセージを入力してください。</dt>
        <dd>
            <?php echo hsc($_SESSION['join']['message']); ?>
        </dd>


        <dt>写真</dt>
        <dd>
            <img src="food_picture/<?php echo hsc($_SESSION['join']['image']); ?>"
            width="100" height="100" alt="">
            
        </dd>

        <h2>URL</h2>
        <div>
        <p><?php echo hsc($_SESSION['join']['url']); ?></p>

        </div>
         
         
        
    </dl>

    <input type="submit" value="送信">

    </form>
    
</body>
</html>