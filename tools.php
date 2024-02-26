<?php

class Tools
{

    

    static function update($mysqli, $zip, $a,$b,$c)
    {
        $query = "UPDATE adatok SET city='$c', zip_code='$b', county='$a' WHERE zip_code = $zip;";
        $mysqli->query($query);
    }
    static function delete($mysqli, $zip)
    {
        $query = "DELETE FROM adatok WHERE zip_code = $zip";

        $mysqli->query($query);
    }
    static function addData($mysqli, $a, $b, $c) {
        $query = "INSERT INTO adatok (id ,county, zip_code, city) VALUES ('', '$a', '$b', '$c')";

        $mysqli->query($query);
    }
    static function insertVarosok($mysqli, $adatok, $truncate = false){
        if($truncate) {
            $mysqli->query("TRUNCATE TABLE adatok");
        }
        for($i = 0; $i < count($adatok); $i++) {
            $a1 = $adatok[$i][0];
            $a2 = $adatok[$i][1];
            $a3 = $adatok[$i][2];
            $mysqli->query("INSERT INTO adatok (id ,county, zip_code, city) VALUES ('$i', '$a1', '$a2', '$a3')");
        }
    }
    static function getCsvData($file){
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


    static function showVarosok($adatok) {
        echo "
        <style>
        table, th, td {
        border:1px solid black;
        border-collapse: collapse;
        }
        </style>
        <table>
        <tr>
          <th>County</th>
          <th>Zip_code</th>
          <th>City</th>
          <th>Buttons</th>
        </tr>
        ";
        for ($i = 0; $i < count($adatok); $i++) { 
            $a1 = $adatok[$i]['county'];
            $a2 = $adatok[$i]['zip_code'];
            $a3 = $adatok[$i]['city'];
            echo "
            <tr>
                <td>$a1</td>
                <td>$a2</td>
                <td>$a3</td>
                <td>";
                    tools::showChangeButton($a2);
                    tools::showDeleteButton($a2);
                echo"</td>
            </tr>
            ";
        }
        echo "</table>";
    }

    static function showChangeButton($a) {
        echo '
            <form method="post" action="valtoztat.php?zip=' . $a . '">
            <button id="btn-change" name="btn-change" title="change" value="'.$a.'">
            Change data
            </button>
            </form>
        ';
    }

    static function showDeleteButton($a) {
        echo '
        <form method="post" action="">
            <button id="btn-delete" name="btn-delete" title="delete" value="'.$a.'">
            Delete data
            </button>
        </form>
        ';
    }

    static function getCounties() {
        $adatok = tools::getCsvData("zip_codes.csv");
        $counties = [];
        for ($i=0; $i < count($adatok); $i++) { 
            $a = $adatok[$i][0];
            if(!in_array($a, $counties)) {
                array_push($counties, $a);
            }
        }
        return $counties;
    }

    static function showCountiesDropdown(array $counties) 
    {
        $result = '<form method="post">
            <select id="counties-dropdown" name="counties-dropdown">
            <option value = "" selected></option>';
        foreach ($counties as $county) {
            if  ($county == "") {
                
            }
            else {
                $result .= ('<option value = ' . $county . '>' . $county . '</option>');
            }
            
        }
        $result .= '</select>
                    <button type="submit" name="submit">Submit</button>
                    </form>';
        echo $result;
    }

    static function showCountiesDropdown2(array $counties) 
    {
        $result = '<form method="post">
            <select id="counties-dropdown" name="counties-dropdown">
            <option value = "" selected></option>';
        foreach ($counties as $county) {
            if  ($county == "") {
                
            }
            else {
                $result .= ('<option value = ' . $county . '>' . $county . '</option>');
            }
            
        }
        $result .= "</form>
                    <br>";
        echo $result;
    }

    static function showCounties($megyesz, $megyel) {
        $counties = tools::getCounties();
        echo '
        <style>
        table, th, td {
        border:1px solid black;
        border-collapse: collapse;
        }
        </style>
        <table>
        <tr>
          <th>County</th>
          <th>Flag</th>
          <th>Crest</th>
          <th>County Town</th>
          <th>Population</th>
        </tr>
        ';
        for ($i=0; $i < count($counties)*2-2; $i+=2) { 
            $id = $i/2+1;
            $id2 = $i/2;
            $a = '<img src="img/'. $i .'.png" width="300">';
            $b = '<img src="img/'. $i+1 .'.png" width="300">';
            echo "
            <tr>
                <td>$counties[$id]</td>
                <td>$a</td>
                <td>$b</td>
                <td>$megyesz[$id2]</td>
                <td>$megyel[$id2]</td>
            </tr>
            ";
        }
        echo "</table>";
    }

    static function GetByCounty($mysqli, string $name)
    {
        $query = "SELECT city FROM adatok WHERE county = '$name'";
        return $mysqli->query($query)->fetch_all();
    }

    static function showCity($asd) {
        echo "
        <style>
        table, th, td {
        border:1px solid black;
        border-collapse: collapse;
        }
        </style>
        <table>
        <tr>
          <th>City</th>
        </tr>
        ";
        for ($i = 0; $i < count($asd); $i++) { 
            $a1 = $asd[$i][0];
            echo "
            <tr>
                <td>$a1</td>
            </tr>
            ";
        }
        echo "</table>";
    }

    static function Search($mysqli, string $name)
    {
        $query = "SELECT * FROM adatok WHERE zip_code = '$name'";

        return $mysqli->query($query)->fetch_all();
    }

    static function Search2($mysqli, string $name)
    {
        $query = "SELECT * FROM adatok WHERE city = '$name'";

        return $mysqli->query($query)->fetch_all();
    }

    static function showSearch($search) {
        echo "
        <style>
        table, th, td {
        border:1px solid black;
        border-collapse: collapse;
        }
        </style>
        <table>
        <tr>
          <th>County</th>
          <th>Zip_code</th>
          <th>City</th>
          <th>Buttons</th>
        </tr>
        ";
        for ($i = 0; $i < count($search); $i++) { 
            $a1 = $search[$i][1];
            $a2 = $search[$i][2];
            $a3 = $search[$i][3];
            echo "
            <tr>
                <td>$a1</td>
                <td>$a2</td>
                <td>$a3</td>
                <td>";
                    tools::showChangeButton($a2);
                    tools::showDeleteButton($a2);
                echo"</td>
            </tr>
            ";
        }
        echo "</table>";
    }

    static function getAll($mysqli): array
    {
        $query = "SELECT * FROM adatok ORDER BY county, city";

        return $mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    static function showExportBtn()
    {
        echo '
            <form method="post" action="export.php">
                <button id="btn-export" name="btn-export" title="Export to .CSV">
                    <i class="fa fa-file-excel"></i>&nbsp;Export CSV</button>
            </form>';
    }
    

}


