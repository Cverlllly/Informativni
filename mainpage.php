
<?php
include 'navbar.php';
$_COOKIE['admin'];
$admin = json_decode($_COOKIE['admin'], true);
$id = $admin['ime'];

// Check if the filter is submitted
if ($id == 'vse') {
  if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
    $sql = "SELECT * FROM prijava p 
            INNER JOIN sole s ON p.sola_id = s.sola_id 
            INNER JOIN kontaktni_podatki k ON p.kontakt_id = k.kontakt_id 
            WHERE p.sprejeta = '$filter'";
  } else {
    $sql = "SELECT * FROM prijava p 
            INNER JOIN sole s ON p.sola_id = s.sola_id 
            INNER JOIN kontaktni_podatki k ON p.kontakt_id = k.kontakt_id";
  }
} else {
  if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
    $sql = "SELECT * FROM prijava p 
            INNER JOIN sole s ON p.sola_id = s.sola_id 
            INNER JOIN kontaktni_podatki k ON p.kontakt_id = k.kontakt_id 
            WHERE p.sprejeta = '$filter' AND ime_obisk='$id'";
  } else {
    $sql = "SELECT * FROM prijava p 
            INNER JOIN sole s ON p.sola_id = s.sola_id 
            INNER JOIN kontaktni_podatki k ON p.kontakt_id = k.kontakt_id 
            WHERE ime_obisk='$id'";
  }
}

$result = $conn->query($sql);

?>

<div class="container-filter">
  <form action="" method="get">
    <label for="filter">Filter by Done:</label>
    <select id="filter" name="filter">
      <option value=''>All</option>
      <option value="1">Complete</option>
      <option value="0">In progress</option>
    </select>
    <button type="submit">Filter</button>
  </form>
</div>

<br><br><br>

<?php
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "<div class='data-container'>";
    echo "<div class='data-row' data-id='" . $row["prijava_id"] . "'>";
    echo $row["ime_sole"] . '&nbsp' . "<div id='test'>" . $row["ime"] . '&nbsp' . $row["priimek"] . "</div>";
    echo "<div class='buttons-container'>";
    echo "<button class='accept-button'>Accept</button>";
    echo "<button class='delete-button'>Delete</button>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
  }
} else {
  echo "No data to display";
}

$conn->close();
?>

<script>
  var dataRows = document.querySelectorAll('.data-row');
  for (var i = 0; i < dataRows.length; i++) {
    dataRows[i].addEventListener('click', function () {
      var id = this.dataset.id;
      window.location.href = 'details.php?id=' + id;
    });
  }
</script>

</body>
</html>