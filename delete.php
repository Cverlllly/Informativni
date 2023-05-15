<?php
include 'header.php';
$id = $_POST['id'];
$sql = "UPDATE prijava SET sprejeta = 3 WHERE prijava_id = $id";
$result = $conn->query($sql);
if ($result) {
    echo "Data updated successfully";
    $sql = "SELECT termin_id FROM prijava WHERE prijava_id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $test = $row['termin_id'];

    $sql = "UPDATE prijava SET termin_id=NULL WHERE prijava_id = $id";
    $conn->query($sql);
    $sql = "UPDATE termini SET prosto=1 WHERE termini_id = $test";
    $conn->query($sql);
    

} else {
    echo "Error updating data: " . $conn->error;
}
$conn->close();
?>