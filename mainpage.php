<?php
// Check if the cookie is set
if(isset($_COOKIE['admin'])){
    $admin = json_decode($_COOKIE['admin'], true);
    $username = $admin['username'];
} else {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome <?php echo $username; ?>!</h1>
    <a href="logout.php">Logout</a>
</body>
</html>