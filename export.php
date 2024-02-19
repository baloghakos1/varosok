<?php
$servername = "localhost";
$username = "root";
$password = null;
$database = "varosok";
$mysqli = new mysqli($servername, $username, $password, $database);
require_once "tools.php";
header('Content-Type: application/csv; charset-UTF-8');
header('Content-Disposition: attachment; filename="zip_codes.csv"');
$makers = tools::getAll($mysqli);
$csvFile = fopen('php://output','w');
fputcsv($csvFile, ['id', 'name']);
foreach ($makers as $maker) {
    fputcsv($csvFile, $maker);
}
fclose($csvFile);