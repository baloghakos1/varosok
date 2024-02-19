<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Counties</title>
</head>
<body>
    <a href="varosok.php"><button>Városok</button></a>
    <a href="county_data.php"><button>Megye adatok</button></a>
    <h1>Megyék</h1>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = null;
    $database = "varosok";
    $mysqli = new mysqli($servername, $username, $password, $database);
    require_once 'tools.php';
    $counties = tools::getCounties();
    tools::showCountiesDropdown($counties);
    tools::showExportBtn();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['counties-dropdown'])) {
            $selected_option = $_POST['counties-dropdown'];
            $asd = tools::GetByCounty($mysqli, $selected_option);
            echo "<br>";
            tools::showCity($asd);
        } else {
            echo "<p>No option selected</p>";
        }
    }
    ?>
</body>
</html>