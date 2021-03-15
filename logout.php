<?php

// session_start();
// session_regenerate_id(true);

// $_SESSION = array();
// if (ini_get("session.use_cookies")) {
//   $params = session_get_cookie_params();
//   setcookie(session_name(), '', time() - 4200,
//     $params['path'], $params['domain'], $params['secure'], $params['httponly'],
//   );
// }
// session_destroy();

// setcookie('email', '', time() - 3600);
// setcookie('password', '', time() - 3600);


// exit();
?>

<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <title>ログアウト</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">

  </head>

  <body>
    <div id="wrap">
        <h1>Instagram</h1>
    
        <p>ログアウトしました</p>
        <p>またのご利用をお待ちしております。</p>

        <div class="btn-border-gradient-wrap">
            <a href="login.php" class="btn btn-border-gradient">ログイン</a>
        </div>
    </div>
  </body>

</html>