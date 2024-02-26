<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hozzaad</title>
</head>
<body>
<a href="varosok.php"><button>Mégse</button></a>

<form method="post">
<label for="input2">zip_code:</label><br>
  <input type="text" id="input2" name="input2"><br>
  <label for="input3">city:</label><br>
  <input type="text" id="input3" name="input3"><br>
  <label for="input1">county:</label><br>
  <?php
  require_once 'tools.php';
  $counties = tools::getCounties();
  tools::showCountiesDropdown2($counties);
  ?>
  <input type="submit" value="Submit">
</form>

<?php
require_once 'tools.php';
$servername = "localhost";
$username = "root";
$password = null;
$database = "varosok";
$mysqli = new mysqli($servername, $username, $password, $database);
if (isset($_POST['counties-dropdown'])) {
  $input1 = $_POST['counties-dropdown'];
  $input2 = $_POST['input2'];
  $input3 = $_POST['input3'];
}
  if(isset($input1)) {
    tools::addData($mysqli,$input1,$input2,$input3);
  }
?>

</body>
</html>