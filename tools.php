<?php

class Tools
{

    public $megyeszekhelyek = ["Kecskemét","Pécs","Békéscsaba","Miskolc","Szeged","Székesfehérvár","Győr","Debrecen","Eger","Szolnok","Tatabánya","Salgótarján","Budapest","Kaposvár","Nyíregyháza","Szekszárd","Szombathely","Veszprém","Zalaegerszeg"];
    public $megye_lakossag = [503825,360704,334264,642447,399012,417712,467144,527989,294609,370007,299207,189304,1278874,301429,552964,217463,253551,341317,268648];

    static function updateVarosok($data) {
        
    }
    static function deleteVarosok($data) {

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

    static function showVarosok() {
        $adatok = tools::getCsvData("zip_codes.csv");
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
            $a1 = $adatok[$i][0];
            $a2 = $adatok[$i][1];
            $a3 = $adatok[$i][2];
            echo "
            <tr>
                <td>$a1</td>
                <td>$a2</td>
                <td>$a3</td>
                <td>";
                    tools::showChangeButton();
                    tools::showDeleteButton();
                echo"</td>
            </tr>
            ";
        }
        echo "</table>";
    }

    static function showChangeButton() {
        echo '
            <button id="btn-change" name="btn-change" title="change">
            Change data
            </button>
        ';
    }

    static function showDeleteButton() {
        echo '
            <button id="btn-delete" name="btn-delete" title="delete">
            Delete data
            </button>
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
        $result = '<select id="counties-dropdown" name="counties-dropdown">';
        foreach ($counties as $county) {
            if  ($county == "") {
                $result .= '<option value ';
            }
            else {
                $result .= ('<option value = ' . $county . '"selected>' . $county . '</option>');
            }
            
        }
        $result .= '</select>';
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



}


