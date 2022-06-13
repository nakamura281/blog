<?php
session_start();

$_SESSION = [];
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 4200, '/');
}
session_destroy();
?>


<p>ログアウトしました。</p>
<a href="siginin.php">ログインへ</a>