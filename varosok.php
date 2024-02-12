<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Varosok</title>
</head>
<body>
    <a href="counties.php"><button>Megye lista</button></a>
    <a href="county_data.php"><button>Megye adatok</button></a>
    <h1>Városok</h1>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = null;
        $database = "varosok";
        $mysqli = new mysqli($servername, $username, $password, $database);
        require_once 'tools.php';
        $file = "zip_codes.csv";
        $data = tools::getCsvData($file);
        tools::insertVarosok($mysqli, $data, false);
        tools::showVarosok(); 


    ?>
</body>
</html>