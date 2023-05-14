<?php include 'header.php';
if(isset($_COOKIE['admin'])){
    $admin = json_decode($_COOKIE['admin'], true);
    $username = $admin['username'];
} else {
    header('Location: login.php');
    exit();
};?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" href="navbar.css">
    <style>
        .navbar{
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-family: Arial, Helvetica, sans-serif;
            height: 100px;
            position: sticky;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color:  <?php $admin = json_decode($_COOKIE['admin'], true);
                $id = $admin['ime'];
                error_log($id);
                    switch ($id) {
                        case 'ssgo':
                            echo "#a6ce39"; 
                            break;
                        case 'ers':
                            echo "#0094d9"; 
                            break;
                        case 'ssd':
                            echo "#ee5ba0"; 
                            break;
                        case 'gim':
                            echo "#ffca05"; 
                            break;
                        case 'vse':
                            echo "#f5f5f5"; 
                            break;
                    }
                ?>;
        }

    </style>
</head>
<body>
<nav class="navbar">
  <div class="navbar-left">
    <a href="mainpage.php?filter=all"><img src="https://www.scv.si/wp-content/themes/yoo_master2_wp/images/scv.svg" alt="Logo" width="230" height="140"></a>
  </div>
  <div class="navbar-right">
    <ul>
      <li><a href="termini.php">Koledar</a></li>
      <li><a href="mainpage.php?filter=all">Termini</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>
</nav>