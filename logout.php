<?php
session_start();
// Unset the cookie
setcookie('admin', '', time() - (86400 * 30), '/');
$_SESSION = array();
session_destroy();
// Debug statements
echo "Cookie unset: ".$_COOKIE['admin']."<br>";
echo "Redirecting to login page...<br>";

header('Location: select_school.php');
exit();
?>