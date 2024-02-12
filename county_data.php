<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>county_data</title>
</head>
<body>
    <a href="varosok.php"><button>Városok</button></a>
    <a href="counties.php"><button>Megye lista</button></a>
    <h1>Megyék adatai</h1>
    <?php
    require_once 'tools.php';
    $megyeszekhelyek = ["Kecskemét","Pécs","Békéscsaba","Miskolc","Szeged","Székesfehérvár","Győr","Debrecen","Eger","Szolnok","Tatabánya","Salgótarján","Budapest","Kaposvár","Nyíregyháza","Szekszárd","Szombathely","Veszprém","Zalaegerszeg"];
    $megye_lakossag = [503825,360704,334264,642447,399012,417712,467144,527989,294609,370007,299207,189304,1278874,301429,552964,217463,253551,341317,268648];
    tools::showCounties($megyeszekhelyek,$megye_lakossag);
    ?>
    
</body>
</html>