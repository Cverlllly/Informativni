<head>
    <link rel="stylesheet" href="form.css">
</head>
<?php
include 'navbar.php';
?>
<?php
$query = "SELECT mentor_id,ime, priimek FROM mentorji";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mentorOptions[] = $row; // Add each mentor row to the options array
    }
}
$id = $_GET['id'];
$sql = "SELECT * FROM prijava p inner join sole s on p.sola_id=s.sola_id inner join kontaktni_podatki k on p.kontakt_id= k.kontakt_id inner join termini t on t.termini_id=p.termin_id WHERE p.prijava_id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="container">
  <h2>Podatki</h2>
  <form action='update_mentor.php' method="post">
    <div class="form-group">
      <label for="ime_sole">Ime šole:</label>
      <input type="text" id="ime_sole" name="ime_sole" value="<?php echo $row['ime_sole']; ?>" class="form-control" disabled='true'>
    </div>
    <div class="form-group">
      <label for="ime">Kontaktna oseba: </label>
      <button type="button" onclick="showDetails()" class="btn btn-primary">
        <?php echo $row['ime'] . ' ' . $row['priimek']; ?>
      </button>
    </div>
    <div id="details" style="display: none;">
      <h3>Dodatni podatki:</h3>
      <p>Email: <?php echo $row['email']; ?></p>
      <p>Telefon: <?php echo $row['telefonska']; ?></p>
    </div><br>
    <div class="form-group">
      <label for="nacin_izvedbe">Način izvedbe:</label>
      <input type="text" id="nacin_izvedbe" name="nacin_izvedbe" value="<?php echo $row['nacin_izvedbe']; ?>" class="form-control" disabled='true'>
    </div>
    <div class="form-group">
      <label for="datum">Datum obiska:</label>
      <input type="text" id="datum" name="datum" value="<?php echo $row['datum']; ?>" class="form-control" disabled='true'>
    </div>
    <div class="form-group">
      <label for="urnik_obiska">Urnik obiska:</label>
      <input type="text" id="urnik_obiska" name="urnik_obiska" value="<?php echo $row['urnik_obiska']; ?>" class="form-control" disabled='true'>
    </div>
    <div class="form-group">
      <label for="starostna_skupina_otrok">Starostna skupina otrok:</label>
      <input type="text" id="starostna_skupina_otrok" name="starostna_skupina_otrok" value="<?php echo $row['starostna_skupina_otrok']; ?>" class="form-control" disabled='true'>
    </div>
    <div class="form-group">
      <label for="st_ucencev">Število učencev:</label>
      <input type="text" id="st_ucencev" name="st_ucencev" value="<?php echo $row['st_ucencev']; ?>" class="form-control" disabled='true'>
    </div>
    <div class="form-group">
      <label for="pricakovanja">Pričakovanja:</label>
      <input type="text" id="pricakovanja" name="pricakovanja" value="<?php echo $row['pricakovanja']; ?>" class="form-control" disabled='true'>
    </div>
    <div class="form-group">
      <label for="sredstva">Sredstva:</label>
      <input type="text" id="sredstva" name="sredstva" value="<?php echo $row['sredstva']; ?>" class="form-control" disabled='true'>
    </div>
    <div class="form-group">
        <label for="sporocilo">Sporočilo</label><br>
        <textarea id="sporocilo" name="sporocilo" disabled='true'><?php echo $row['sporocilo']; ?></textarea>
    </div>
    <div class="form-group">
        <label for="cas_prijave">Čas prijave</label>
        <input type="text" id="cas_prijave" name="cas_prijave" value="<?php echo $row['cas_prijave']; ?>" class="form-control" disabled='true'>
    </div>
    <div class="form-group">
        <label for="sprejeta">Sprejeto</label>
        <input type="text" id="sprejeta" name="sprejeta" value="<?php echo $row['sprejeta']; ?>" class="form-control" disabled='true'>
    </div>
    <div class="form-group">
        <label for="sola_id">Obisk šole</label>
        <input type="text" id="sola_id" name="sola_id" value="<?php echo $row['ime_obisk']; ?>" class="form-control"disabled='true'>
    </div>
    <?php 
    if($test == 'vse'){
    }
    else
    {
      ?>
      <script>
        console.log($test)
        </script>
    <div class="form-group">
        <label for="mentor">Mentor</label>
        <select id="mentor" name="mentor" class="form-control">
            <?php foreach ($mentorOptions as $mentor) : ?>
                <option value="<?php echo $mentor['mentor_id']; ?>"><?php echo $mentor['ime']; ?> <?php echo $mentor['priimek']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <?php
    } 
    ?>
    <?php
      echo "<input type='hidden' name='prijava_id' value='$id'>";
    ?>
    
    <button type="submit" name='subbtn' onclick="updateMentor(<?php echo $id ?>)" class="btn btn-primary">
      Potrdi
    </button>
  </form>
</div>

<script>
function showDetails() {
  var details = document.getElementById("details");
  if (details.style.display === "none") {
    details.style.display = "block";
  } else {
    details.style.display = "none";
  }
}
function updateMentor(id) {
  
  const sql = 'UPDATE prijava SET mentor_id = ${selectedMentorId} WHERE prijava_id=${id}';
  connection.query(sql, function (error, results, fields) {
    if (error) {
      console.error('Error updating mentor:', error);
      return;
    }
    console.log('Mentor updated successfully!');
  });
}
</script>

<?php
$conn->close();
?>