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
    require_once 'tools.php';
    $counties = tools::getCounties();
    tools::showCountiesDropdown($counties);
    ?>
</body>
</html>