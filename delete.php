<?php
include 'header.php';
$id = $_POST['id'];
$sql = "UPDATE prijava SET sprejeta = 3 WHERE prijava_id = $id";
$result = $conn->query($sql);
if ($result) {
    echo "Data updated successfully";
} else {
    echo "Error updating data: " . $conn->error;
}
$conn->close();
?>