<?php

    require("../libs/baza.class.php");

    //// Dohvati lokacije
    $db = new Baza();
    $db->spojiDB();
    $add= "";
    if(isset($_GET["vrsta"]) || isset($_GET["centar"])){
        
        $centar = str_replace("_", " ", $_GET["centar"]);
        $vrsta = str_replace("_", " ", $_GET["vrsta"]);
        if(!empty($centar) && !empty($vrsta)){
            $add = "WHERE `rc`.`Naziv` = '$centar' AND `vrsta`.`Vrsta_lokacije` = '$vrsta'";
        }
        else if(empty($centar)){
            $add = "WHERE `vrsta`.`Vrsta_lokacije` = '$vrsta'";
        }
        else if(empty($vrsta)){
            $add = "WHERE `rc`.`Naziv` = '$centar'";
        }
    }
    $query = "SELECT `lc`.`ID`,  `lc`.`Naziv`, `Vrijeme_prijevoza`, `Dubina`, `Broj_mjesta`, `lc`.`Opis`,
                     `vrsta`.`Vrsta_lokacije`, `rc`.`Naziv`, `grad`.`Naziv`,  `lc`.`ID_centar`
                FROM `lokacija_za_ronjenje` as `lc` 
                LEFT JOIN `vrsta_ronilacke_lokacije` as `vrsta` ON `lc`.`ID_vrsta_lokacije` = `vrsta`.`ID` 
                LEFT JOIN `ronilacki_centar` as `rc` ON `lc`.`ID_centar` = `rc`.`ID` 
                LEFT JOIN `grad` ON `lc`.`ID_grad` = `grad`.`ID` $add";

    $odgovor = array();
    $result = $db->selectDB($query);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_row($result)) {
            $redak["id"] = $row[0];
            $redak["naziv"] = $row[1];
            $redak["vrijeme"]=$row[2];
            $redak["dubina"] = $row[3];
            $redak["brojMjesta"] = $row[4];
            $redak["opis"]=$row[5];
            $redak["vrsta"]=$row[6];
            $redak["centar"]=$row[7];
            $redak["grad"]=$row[8];
            $redak["idCentar"] = $row[9];
            $odgovor[] = $redak;
        }
    }
    

    $db->zatvoriDB();
    header("Content-Type: application/json");
    echo json_encode($odgovor);
?>