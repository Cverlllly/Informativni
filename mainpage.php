<?php
include 'navbar.php';
$_COOKIE['admin'];
$admin = json_decode($_COOKIE['admin'], true);
$id = $admin['ime'];
if ($id == 'vse') {
  if (($_GET['filter']) != 'all') {
    $filter = $_GET['filter'];
    $sql = "SELECT * FROM prijava p 
            INNER JOIN sole s ON p.sola_id = s.sola_id 
            INNER JOIN kontaktni_podatki k ON p.kontakt_id = k.kontakt_id 
            WHERE p.sprejeta = '$filter'";
  } else if ($_GET['filter'] == 'all') {
    $sql = "SELECT * FROM prijava p 
            INNER JOIN sole s ON p.sola_id = s.sola_id 
            INNER JOIN kontaktni_podatki k ON p.kontakt_id = k.kontakt_id";
  } else {
    $sql = "SELECT * FROM prijava p 
            INNER JOIN sole s ON p.sola_id = s.sola_id 
            INNER JOIN kontaktni_podatki k ON p.kontakt_id = k.kontakt_id";
  }
} else {
  if (($_GET['filter']) != 'all') {
    $filter = $_GET['filter'];
    $sql = "SELECT * FROM prijava p 
            INNER JOIN sole s ON p.sola_id = s.sola_id 
            INNER JOIN kontaktni_podatki k ON p.kontakt_id = k.kontakt_id 
            WHERE p.sprejeta = '$filter' AND ime_obisk='$id'";
  } else if ($_GET['filter'] == 'all') {
    $sql = "SELECT * FROM prijava p 
            INNER JOIN sole s ON p.sola_id = s.sola_id 
            INNER JOIN kontaktni_podatki k ON p.kontakt_id = k.kontakt_id WHERE ime_obisk='$id'";
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
      <option value='all'>All</option>
      <option value="1">Complete</option>
      <option value="0">In progress</option>
      <option value="3">Deleted</option>
    </select>
    <button type="submit">Filter</button>
  </form>
</div>

<br><br><br>

<?php
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    if ($row["sprejeta"] == 1) {
      echo "<div class='data-container'>";
      echo "<div class='data-row' data-id='" . $row["prijava_id"] . "'>";
      echo $row["ime_sole"] . '&nbsp' . "<div id='test'>" . $row["ime"] . '&nbsp' . $row["priimek"] . "</div>";
      echo "<div class='buttons-container'>";
      echo "<button class='undo-button'>Undo</button>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
    } else if ($row["sprejeta"] == 3) {
      echo "<div class='data-container'>";
      echo "<div class='data-row' data-id='" . $row["prijava_id"] . "'>";
      echo $row["ime_sole"] . '&nbsp' . "<div id='test'>" . $row["ime"] . '&nbsp' . $row["priimek"] . "</div>";
      echo "<div class='buttons-container'>";
      echo "<button class='deleted-button'>Deleted</button>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
    } else {
      echo "<div class='data-container'>";
      echo "<div class='data-row' data-id='" . $row["prijava_id"] . "'>";
      echo $row["ime_sole"] . '&nbsp' . "<div id='test'>" . $row["ime"] . '&nbsp' . $row["priimek"] . "</div>";
      echo "<div class='buttons-container'>";
      echo "<button class='accept-button'>Sprejmi</button>";
      echo "<button class='delete-button'>Zavrni</button>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
    }
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
  var undoButtons = document.querySelectorAll('.undo-button');
  for (var i = 0; i < undoButtons.length; i++) {
    undoButtons[i].addEventListener('click', function(event) {
      event.stopPropagation();
      var id = this.parentNode.parentNode.dataset.id;
      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'undo.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onload = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          console.log(xhr.responseText);
          location.reload();
        }
      }
      xhr.send('id=' + id);
    });
  }
  var deleteButtons = document.querySelectorAll('.delete-button');
  for (var i = 0; i < deleteButtons.length; i++) {
    deleteButtons[i].addEventListener('click', function(event) {
      event.stopPropagation();
      var id = this.parentNode.parentNode.dataset.id;
      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'delete.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onload = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          console.log(xhr.responseText);
          location.reload();
        }
      }
      xhr.send('id=' + id);
    });
  }
  var acceptButtons = document.querySelectorAll('.accept-button');
  for (var i = 0; i < acceptButtons.length; i++) {
    acceptButtons[i].addEventListener('click', function(event) {
      event.stopPropagation();
      var id = this.parentNode.parentNode.dataset.id;
      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'accept.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onload = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          console.log(xhr.responseText);
          location.reload();
        }

      }
      xhr.send('id=' + id);
    });
  }
</script>
</body>

</html>