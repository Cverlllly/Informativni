<?php
include 'header.php';

$date = $_POST['date'];

// Insert the selected date into the "termini" table
$sql = "INSERT INTO termini (datum, prosto) VALUES ('$date', 1)";
if ($conn->query($sql) === TRUE) {
  echo "Record inserted successfully";
} else {
  echo "Error inserting record: " . $conn->error;
}

$conn->close();
?>