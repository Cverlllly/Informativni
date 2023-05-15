<?php
include 'header.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $date = $_POST['date'];
  $sql = "INSERT INTO termini (datum, prosto) VALUES ('$date', 1)";
  if ($conn->query($sql) === TRUE) {
    echo "Record inserted successfully";
  } else {
    echo "Error inserting record: " . $conn->error;
  }
} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  $date = $_GET['date'];
  $sql = "DELETE FROM termini WHERE datum = '$date'";
  if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
  } else {
    echo "Error deleting record: " . $conn->error;
  }
}

$conn->close();
?>
