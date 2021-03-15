<?php

require('../../functions.php');

session_start();
require('../../dbconnect.php');


$data = $_POST['image'];
$data = str_replace('data:image/png;base64,', '', $data);  // 冒頭の部分を削除
$data = str_replace(' ', '+', $data);  // 空白を'+'に変換
$image = base64_decode($data);

// ファイルへ保存
$file = sprintf('%s.png', uniqid());    //ファイル名を作成
$result = file_put_contents("./camera/".$file, $image, LOCK_EX);


// データベースに保存
$statement = $db->prepare('INSERT INTO camera SET user_id=?, picture=?');
echo $ret = $statement->execute(array(
    $_SESSION['id'],
    $file
));


echo json_encode($file);
exit();
?>

