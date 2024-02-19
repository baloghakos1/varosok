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
    <form action="" method="post">
        <label for="inputField">Keresés:</label><br>
        <input type="text" id="inputField" name="inputField"><br>
        <button type="submit" name="submitButton">Click me</button>
    </form>
    <br>
    <a href="hozzaad.php"><button>Add data</button></a>
    <br>
    <?php
        echo "<br>";
        $servername = "localhost";
        $username = "root";
        $password = null;
        $database = "varosok";
        $mysqli = new mysqli($servername, $username, $password, $database);
        require_once 'tools.php';
        $file = "zip_codes.csv";
        if (isset($_POST['submitButton'])) {
            $inputValue = $_POST['inputField'];
            $search = tools::Search($mysqli, $inputValue);
            if ($search == null) {
                $search = tools::Search2($mysqli, $inputValue);
                if($search == null) {
                    $data = tools::getCsvData($file);
                    //tools::insertVarosok($mysqli, $data, false);
                    tools::showVarosok(tools::getAll($mysqli));
                }
                else {
                    tools::showSearch($search);
                }
            }
            else {
                tools::showSearch($search);
            }
        }
        if(isset($_POST['btn-delete'])) {
            $zip = $_POST['btn-delete'];
            tools::delete($mysqli, $zip);
        }
        
    ?>
</body>
</html>