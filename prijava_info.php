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

        <form method="post" action="process.php">
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
                <style>
                    input[type="date"]::-webkit-calendar-picker-indicator {
                        filter: invert(25%) sepia(80%) saturate(10000%) hue-rotate(90deg);
                    }
                </style>

                <div class="prasanje">
                    <label>Ime osnovne šole:</label>
                    <input type="text" name="field4">
                </div>
            </div>

            <div class="input-group">
                <div class="prasanje">
                    <label>Ime osnovne šole:</label>
                    <input type="text" name="field5">
                </div>
                <div class="prasanje">
                    <label>Ime osnovne šole:</label>
                    <input type="text" name="field6">
                </div>
                <div class="prasanje">
                    <label>Ime osnovne šole:</label>
                    <input type="text" name="field7">
                </div>
                <div class="prasanje">
                    <label>Ime osnovne šole:</label>
                    <input type="text" name="field8">
                </div>
            </div>

            <div class="input-group">
                <div class="prasanje">
                    <label>Ime osnovne šole:</label>
                    <input type="text" name="field9">
                </div>
                <div class="prasanje">
                    <label>Ime osnovne šole:</label>
                    <input type="text" name="field10">
                </div>
                <div class="prasanje">
                    <label>Ime osnovne šole:</label>
                    <input type="text" name="field11">
                </div>
                <div class="prasanje">
                    <label>Ime osnovne šole:</label>
                    <input type="text" name="field12">
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