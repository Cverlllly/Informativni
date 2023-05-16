<?php include "glava.php"; ?>

<div class=container>

    <div class="big_text" style="margin-top: 50px;">HVALA ZA PRIJAVO!</div>
    <?php
    include 'header.php';
    $ime_os_sole = $_POST['field1'];
    $delavnice = $_POST['field2'];
    if ($delavnice == 'Drugace') {
        $delavnice = $_POST['drugacetext'];
    }
    $datum_obiska = $_POST['field3'];
    $urnik = $_POST['field4'];
    $sola_obiska = $_POST['field5'];
    $starostna_skupina = $_POST['field6'];
    $telefonska = $_POST['field7'];
    $email = $_POST['field8'];
    $st_ucencev = $_POST['field9'];
    $pricakovanja = $_POST['field10'];
    $sporocilo = $_POST['field11'];
    $sredstva = "";
    if (isset($_POST['field12'])) {
        $sredstva = $_POST['field12'];
    }
    if (isset($_POST['field13'])) {
        $sredstva = $sredstva . " " . $_POST['field13'];
    }
    if (isset($_POST['field14'])) {
        $sredstva = $sredstva . " " . $_POST['field14'];
    }
    if (isset($_POST['field15'])) {
        $sredstva = $sredstva . " " . $_POST['field15'];
    }



    $sql1 = "INSERT INTO kontaktni_podatki(email, telefonska) VALUES('$email','$telefonska');";
    $sql2 = "INSERT INTO prijava(termin_id, ime_sole, nacin_izvedbe, urnik_obiska, starostna_skupina_otrok, st_ucencev, pricakovanja, sredstva, sporocilo, cas_prijave, kontakt_id, sola_id) 
        VALUES((SELECT termini_id FROM termini WHERE datum = '$datum_obiska'), '$ime_os_sole', '$delavnice', '$urnik', 
        '$starostna_skupina', $st_ucencev, '$pricakovanja', '$sredstva', '$sporocilo', '" . date('Y-m-d H:i:s') . "', 
        (SELECT kontakt_id FROM kontaktni_podatki WHERE email = '$email' AND telefonska = '$telefonska' LIMIT 1), $sola_obiska);";
    $sql3 = "UPDATE termini SET prosto = 0 WHERE datum = '$datum_obiska'";

    if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE && $conn->query($sql3) === TRUE) {
        echo "<div class=\"medium_text\" style=\"margin-top: 30px;\">Prijava uspešna! Stran lahko zdaj zaprete</div>";
    } else {
        echo "<div class=\"medium_text\" style=\"margin-top: 30px;\">Nekaj je šlo narobe! Prijava in uspešna</div>";
    }

    $conn->close();
    ?>
</div>
</body>

</html>