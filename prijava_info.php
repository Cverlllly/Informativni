<!DOCTYPE html>
<html>

<head>
    <title> Prijava </title>
    <link rel="stylesheet" href="prijave.css">
    <link href="header.ph" rel="import" type="text/php">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

</head>

<body class="bg">
    <header class="main-header">
        <div class="nav"><img src="slike\scv.png"></div>
    </header>


    <script>
        var groups;
        var currentIndex;

        function drugaceCheck() {
            if (document.getElementById('delavnicedrugacecheck').checked) {
                document.getElementById('drugace').style.visibility = 'visible';
            } else document.getElementById('drugace').style.visibility = 'hidden';

        }

        function showNextGroup() {
            // Hide the current group
            groups[currentIndex].classList.remove('active');

            // Display the next group, if available
            if (groups[currentIndex + 1]) {
                groups[currentIndex + 1].classList.add('active');
                currentIndex++;
            }

            // Show or hide the Next and Back buttons based on the current group
            var nextButton = document.getElementById('nextButton');
            var backButton = document.getElementById('backButton');
            var submitButton = document.getElementById('submitButton')
            nextButton.style.display = groups[currentIndex + 1] ? 'block' : 'none';
            backButton.style.display = currentIndex > 0 ? 'block' : 'none';
            submitButton.style.display = groups[currentIndex + 1] ? 'none' : 'block';
        }

        function showPreviousGroup() {
            // Hide the current group
            groups[currentIndex].classList.remove('active');

            // Display the previous group, if available
            if (groups[currentIndex - 1]) {
                groups[currentIndex - 1].classList.add('active');
                currentIndex--;
            }

            // Show or hide the Next and Back buttons based on the current group
            var nextButton = document.getElementById('nextButton');
            var backButton = document.getElementById('backButton');
            var submitButton = document.getElementById('submitButton')
            nextButton.style.display = groups[currentIndex + 1] ? 'block' : 'none';
            backButton.style.display = currentIndex > 0 ? 'block' : 'none';
            submitButton.style.display = groups[currentIndex + 1] ? 'none' : 'block';
        }

        document.addEventListener('DOMContentLoaded', function() {
            groups = document.getElementsByClassName('input-group');
            currentIndex = 0;

            // Display the first group
            groups[currentIndex].classList.add('active');

            // Show or hide the Next and Back buttons based on the current group
            var nextButton = document.getElementById('nextButton');
            var backButton = document.getElementById('backButton');
            var submitButton = document.getElementById('submitButton')
            nextButton.style.display = groups[currentIndex + 1] ? 'block' : 'none';
            backButton.style.display = currentIndex > 0 ? 'block' : 'none';
            submitButton.style.display = groups[currentIndex + 1] ? 'none' : 'block';

        });
    </script>
    <div class="container">
        <h1>Your Application</h1>

        <form method="post" action="obdelava_prijave.php">
            <div class="input-group active">
                <div class="prasanje">
                    <label>Ime osnovne šole:</label>
                    <input type="text" name="field1">
                </div>
                <div class="prasanje">
                    <label>Kako želite izvesti delavnice na ŠC Velenje:</label>
                    <div class="radiolayout">
                        <input type="radio" name="field2" value="Delavnice bi izvedli na ŠC Velenje" onClick="drugaceCheck()">
                        <input type="radio" name="field2" value="Delavnice bi izvedli na naši šoli" onClick="drugaceCheck()">
                        <input type="radio" name="field2" value="Roditeljski sestanek na OŠ" onClick="drugaceCheck()">
                        <input type="radio" id="delavnicedrugacecheck" name="field2" value="Drugace" onClick="drugaceCheck()">
                    </div>

                    <div class="radiolayout">
                        <label>Delavnice bi izvedli na ŠC Velenje</label>
                        <label>Delavnice bi izvedli na naši šoli</label>
                        <label>Roditeljski sestanek na OŠ</label>
                        <label>Drugace</label>
                        <input type="text" id="drugace" name="drugacetext" style="visibility:hidden;">
                    </div>
                </div>
                <div class="prasanje">
                    <label>Izberite datum obiska:</label>
                    <input type="text" name="field3" id="selectedDateInput">
                </div>

                <script>
                    // Define an array of allowed dates

                    var allowedDates = <?php include 'header.php';
                                        $sql = "SELECT datum FROM termini WHERE prosto = 1";
                                        $result = $conn->query($sql);
                                        echo "[";
                                        while ($row = $result->fetch_assoc()) {
                                            echo "'" . $row['datum'] . "', ";
                                        }
                                        echo "]";
                                        $conn->close();
                                        ?>;
                    // Get the date input element
                    var selectedDateInput = document.getElementById('selectedDateInput');

                    flatpickr("#selectedDateInput", {
                        enable: allowedDates
                    });
                </script>

                <div class="prasanje">
                    <label>Želen urnik obiska: <br> (pričetek, malica, zaključek) </label>
                    <input type="text" name="field4">
                </div>
            </div>

            <div class="input-group">
                <div class="prasanje">
                    <label>Katero šolo boste obiskali:</label>
                    <div class="radiolayout">
                        <input type="radio" name="field5" value="1">
                        <input type="radio" name="field5" value="2">
                        <input type="radio" name="field5" value="3">
                        <input type="radio" name="field5" value="4">
                        <input type="radio" name="field5" value="5">
                    </div>

                    <div class="radiolayout">
                        <label>Gimnazija</label>
                        <label>Elektro računalniška šola</label>
                        <label>Šola za storitvene dejavnosti</label>
                        <label>Šola za strojništvo, geotehniko in okolje</label>
                        <label>Vse</label>
                    </div>
                </div>

                <div class="prasanje">
                    <label>Starostna skupina otrok:</label>
                    <div class="radiolayout">
                        <input type="radio" name="field6" value="7 razred">
                        <input type="radio" name="field6" value="8 razred">
                        <input type="radio" name="field6" value="9 razred">
                    </div>

                    <div class="radiolayout">
                        <label>7. razred</label>
                        <label>8. razred</label>
                        <label>9. razred</label>
                    </div>
                </div>
                <div class="prasanje">
                    <label>Telefonska številka kontaktne osebe:</label>
                    <input type="text" name="field7">
                </div>
                <div class="prasanje">
                    <label>E-naslov kontaktne osebe:</label>
                    <input type="text" name="field8">
                </div>
            </div>

            <div class="input-group">
                <div class="prasanje">
                    <label>Število učencev:</label>
                    <input type="text" name="field9">
                </div>
                <div class="prasanje">
                    <label>Pričakovanja:</label>
                    <input type="text" name="field10">
                </div>
                <div class="prasanje">
                    <label>Nam kaj želite sporočiti:</label>
                    <input type="text" name="field11">
                </div>
                <div class="prasanje">
                    <label>Sredstva na vasi soli:</label>
                    <div class="radiolayout">
                        <input type="checkbox" name="field12" value="Racunalnik">
                        <input type="checkbox" name="field13" value="Projektor">
                        <input type="checkbox" name="field14" value="Zvocniki">
                        <input type="checkbox" name="field15" value="Skupine so locene po razredih">
                    </div>

                    <div class="radiolayout">
                        <label>Racunalnik</label>
                        <label>Projektor</label>
                        <label>Zvocniki</label>
                        <label>Skupine so locene po razredih</label>
                    </div>
                </div>
            </div>
            <div class="button-group">
                <button type="button" id="backButton" onclick="showPreviousGroup()">Back</button>
                <button type="button" id="nextButton" onclick="showNextGroup()">Next</button>
                <input type="submit" id="submitButton" value="Submit">
            </div>
        </form>
    </div>
</body>

</html>