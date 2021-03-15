<?php

session_start();
require('../dbconnect.php');
require('../functions.php');


if(!isset($_SESSION['join'])){
    header('Location: index.php');
    exit();
}

if (!empty($_POST)){

    $statement = $db->prepare('INSERT INTO posts SET user_name=?, email=?, phone=?, password=?, picture=?');
    echo $ret = $statement->execute(array(
        $_SESSION['join']['username'],
        $_SESSION['join']['email'],
        $_SESSION['join']['phone_num'],
        sha1($_SESSION['join']['password']),
        $_SESSION['join']['image']
    ));


    header('Location: thanks.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">

</head>
<body>
<div id="wrap">
    <dl>
    <h1>Instagram</h1>
        <dt>ニックネーム</dt>
        <dd>
            <?php echo hsc($_SESSION['join']['username']);?>
        </dd>

        <dt>メールアドレス</dt>
        <dd>
        </dd>
        <dt>電話番号</dt>
        <dd>
        <?php echo hsc($_SESSION['join']['phone_num']);?>
        </dd>
        <dt>パスワード</dt>
        <dd>
            [表示されません]
        </dd>
        <dt>写真</dt>
        <dd>
            <img src ="member_picture/<?php echo hsc($_SESSION['join']['image']) ;  ?>"
            class="pic" alt="" />
        </dd>
    </dl>
    <div>
        <form action="" method="post">
            <input type="hidden" name="action" value="submit" />
            <div>
                <a href="singin.php?action=rewrite">&laquo;&nbsp;書き直す</a> | <input type="submit" value="登録する">
            </div>
        </form>
    </div>

</div>
    
</body>
</html>

