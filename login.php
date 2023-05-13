<?php include 'header.php';
// Start the session
session_start();
$sola=isset($_GET['sola']) ? $_GET['sola'] : '';

if (isset($_SESSION['admin_id'])) {
    // Redirect to the home page
    header('Location: mainpage.php');
    exit;
}

// Check if the login form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Sanitize the input data  
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Query the database for the user
    $sql = "SELECT a.admin_id,a.username,ime FROM admini a INNER JOIN sole s on a.sola_id=s.sola_id WHERE username = '$username' AND passwrod = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Log the user in and redirect to the home page
        $row = $result->fetch_assoc();
        if($row['ime']==$sola){
            $_SESSION['admin_id'] = $row['admin_id'];
            setcookie('admin', json_encode(array('admin_id' => $row['admin_id'], 'username' => $row['username'],'ime'=>$row['ime'])), time() + (86400 * 30), '/');
            header('Location: mainpage.php');
            exit;
        }else{
            $error = 'Invalid username for this school';
        }
    } else {
        // Display an error message
        $error = 'Invalid username or password';
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Select School </title>
        <link rel="stylesheet" href="login.css">
        <link href="header.php" rel="import" type="text/php">
        <style>
            body {
                margin: 0;
                padding: 0;
                background-color: <?php $id = isset($_GET['sola']) ? $_GET['sola'] : '';
                    switch ($id) {
                        case 'ssgo':
                            echo "#a6ce39"; // red
                            break;
                        case 'ers':
                            echo "#0094d9"; // green
                            break;
                        case 'ssd':
                            echo "#ee5ba0"; // blue
                            break;
                        case 'gim':
                            echo "#ffca05"; // white
                            break;
                        case 'vse':
                            echo "#f5f5f5"; // black
                            break;
                    }
                ?>;
                font-family: Arial, sans-serif;
                font-size: 14px;
                color: #000000;
                }
                input[type="submit"] {
            margin-left: 25%;
            margin-top: 20%;
            width: 50%;
            height: 40px;
            background-color: <?php $id = isset($_GET['sola']) ? $_GET['sola'] : '';
                        switch ($id) {
                            case 'ssgo':
                                echo "#a6ce39"; // red
                                break;
                            case 'ers':
                                echo "#0094d9"; // green
                                break;
                            case 'ssd':
                                echo "#ee5ba0"; // blue
                                break;
                            case 'gim':
                                echo "#ffca05"; // white
                                break;
                            case 'vse':
                                echo "#f5f5f5"; // black
                                break;
                        }
                    ?>;;
            color: #000000;
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
            }
            input[type="submit"]:hover {
                background-color:<?php $id = isset($_GET['sola']) ? $_GET['sola'] : '';
                            switch ($id) {
                                case 'ssgo':
                                    echo "#7c9b2a"; // red
                                    break;
                                case 'ers':
                                    echo "#0071a5"; // green
                                    break;
                                case 'ssd':
                                    echo "#bb477d"; // blue
                                    break;
                                case 'gim':
                                    echo "#cca104"; // white
                                    break;
                                case 'vse':
                                    echo "#c2c2c2"; // black
                                    break;
                            }
                        ?>;;
            }
        </style>
    </head>
    <body>
    <?php if(isset($error_message)) { ?>
        <p><?php echo $error_message; ?></p>
    <?php } ?>
    <div class="container">
		<form class="form" method="post" action="">
			<label for="username">Username:</label>
			<input type="text" id="username" name="username">
			<label for="password">Password:</label>
			<input type="password" id="password" name="password">
			<input type="submit" value="Log In">
		</form>
	</div>
    </body>
</html>
