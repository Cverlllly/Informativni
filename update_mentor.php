<?php
include 'navbar.php';
if(isset($_POST['subbtn'])){
    $mentor_id=$_POST['mentor'];
    $prijava_id=$_POST['prijava_id'];
    $sql = "UPDATE prijava SET mentor_id = $mentor_id WHERE prijava_id = $prijava_id";
    $result = $conn->query($sql);
    if ($result) {
        echo "Data updated successfully";
    } else {
        echo "Error updating data: " . $conn->error;
    }
    $conn->close();
}
header("location: mainpage.php?filter=all");
exit;
?>