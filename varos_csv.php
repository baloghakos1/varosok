<?php
ini_set('memory_limit','-1');
$servername = "localhost";
$username = "root";
$password = null;
$mysqli = new mysqli($servername, $username, $password);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$sql = "CREATE DATABASE IF NOT EXISTS varosok";
if ($mysqli->query($sql) === TRUE) {
  echo "Database created successfully\n";
} else {
  echo "Error creating database: " . $mysqli->error;
}
$sql = "CREATE TABLE IF NOT EXISTS adatok (
    id int,
    megye varchar(255),
    zip_kod varchar(255),
    varos varchar(255)
)";
$mysqli->close();
$database = "varosok";
$mysqli = new mysqli($servername, $username, $password, $database);
if ($mysqli->query($sql) === TRUE) {
    echo "Table created successfully\n";
} else {
    echo "Error creating Table: " . $mysqli->error;
}

$file = "zip_codes.csv";
function getCsvData($file){
    $array = [];
    if(!file_exists($file)){
        echo "$file nem található";
        return false;
    }
    $csv = fopen($file, 'r');
    $line = fgetcsv($csv);
    while (!feof($csv)) {
        $line = fgetcsv($csv);
        $array[] = $line;
    }
    fclose($csv);
    return $array;
}


$adatok = getCsvData($file);

function insertAdatok($mysqli, $adatok, $truncate = false){
    if($truncate) {
        $mysqli->query("TRUNCATE TABLE adatok");
    }
    for($i = 0; $i < count($adatok); $i++) {
        $a1 = $adatok[$i][0];
        $a2 = $adatok[$i][1];
        $a3 = $adatok[$i][2];
        $mysqli->query("INSERT INTO adatok (id ,megye, zip_kod, varos) VALUES ('$i', '$a1', '$a2', '$a3')");
    }
}

insertAdatok($mysqli,$adatok,true);




