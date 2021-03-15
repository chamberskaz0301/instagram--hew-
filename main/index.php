<?php
require('../functions.php');

session_start();
require('../dbconnect.php');
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()){

  $_SESSION['time'] = time();

  $members = $db->prepare('SELECT * FROM posts where id = ?');
  $members->execute(array($_SESSION['id']));
  $member = $members->fetch();

}else{
  header('Location: ../login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOP</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">

</head>
<body>
    <div  id="wrap">
        <h1>Instagram</h1>
    </div>
    
    <table class="top">
        <tr>
            <td>
                <a href="./dm/dm.php" class="circle">DM画面</a>
            </td>
            <td>
                <a href="./user/user.php" class="circle">ユーザー画面</a>
            </td>
            <td class="wrap">
                <a href="./story/story.php" class="circle">ストーリーズリール画面</a>
            </td>
        </tr>
    </table>

    <table class="top">
        <tr>
            <td>
                <a href="post/post.php" class="circle">投稿画面</a>
            </td>
            <td>
                <a href="recom/recom.php" class="circle">オススメ投稿画面</a>
            </td>
            <td>
                <a href="activity/activity.php" class="circle">アクティビティ画面</a>
            </td>
        </tr>
    </table>

    <table class="top">
        <tr>
            <td>
            <a href="post/post_list.php" class="circle">投稿一覧</a>
            </td> 

            <td>
                <a href="../logout.php" class="circle">ログアウト</a>
            </td> 

            <td>
            <a href="#" class="circle"> IT5A2</a>
            </td>


  
  
         </tr> 
    </table>




    
    
</body>
</html>