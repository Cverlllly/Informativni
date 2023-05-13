<head>
    <link rel="stylesheet" href="form.css">
</head>
<?php

include 'navbar.php';
$id = $_GET['id'];
$sql = "SELECT * FROM prijava p inner join sole s on p.sola_id=s.sola_id inner join kontaktni_podatki k on p.kontakt_id= k.kontakt_id WHERE p.prijava_id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="container">
  <h2>Podatki</h2>
  <form>
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
      <label for="datum_obiska">Datum obiska:</label>
      <input type="text" id="datum_obiska" name="datum_obiska" value="<?php echo $row['datum_obiska']; ?>" class="form-control" disabled='true'>
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
  </form>



</div>
<div class="ad_form">
    <form action="" method="post" class="">
        <button id=ja>Sprejmi</button>
        <button id=ne>Zavrni</button>
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
</script>

<?php
$conn->close();
?>