<?php
include 'navbar.php';

// Check if the filter is submitted
if(isset($_GET['filter'])) {
  $filter = $_GET['filter'];
  $sql = "SELECT * FROM prijava p inner join sole s on p.sola_id=s.sola_id inner join kontaktni_podatki k on p.kontakt_id= k.kontakt_id WHERE p.sprejeta = '$filter'";
} else {
  $sql = "SELECT * FROM prijava p inner join sole s on p.sola_id=s.sola_id inner join kontaktni_podatki k on p.kontakt_id= k.kontakt_id";
}

$result = $conn->query($sql);

?>
<div class="container-filter">
<form action="" method="get">
  <label for="filter">Filter by Done:</label>
  <select id="filter" name="filter">
    <option value="">All</option>
    <option value="1">Complete</option>
    <option value="0">In progress</option>
  </select>
  <button type="submit">Filter</button>
</form>
</div>

<?php
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "<div class='data-container'>";
    echo "<div class='data-row' data-id='" . $row["prijava_id"] . "'>";
        echo  "<div>". $row["ime_sole"].'&nbsp'.$row["ime"].'&nbsp'.$row["priimek"].'&nbsp'.$row["datum_obiska"]." </div>";
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
    dataRows[i].addEventListener('click', function() {
      var id = this.dataset.id;
      window.location.href = 'details.php?id=' + id;
    });
  }
</script>
</body>
</html>