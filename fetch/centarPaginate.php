<?php
    require("../libs/baza.class.php");
    $db = new Baza();
        $db->spojiDB();
    if(isset($_GET['rowid'])){
        $rowid = $_GET['rowid'];
        $rowperpage = $_GET['rowperpage'];
        $sql = "select count(id) from ronilacki_centar";
        $result = $db->selectDB($sql);
        $ukupnoZapisa = mysqli_fetch_array($result)[0];

        $sql = "SELECT `rc`.`ID`, `rc`.`Naziv`, `OIB`, `Telefon`, 
        `Datum_osnivanja`, `Ulica`, `grad`.`Naziv`,
         `grad`.`Postanski_broj` , logo 
        FROM `ronilacki_centar` as `rc` 
        LEFT JOIN `grad` on `ID_grad` = `grad`.`ID`
        LIMIT $rowid, $rowperpage";

        
        $result = $db->selectDB($sql);

        $odgovor = array();
        $redak["ukupno"] = $ukupnoZapisa;
        $odgovor[] = $redak;
        while($row = mysqli_fetch_array($result)){
            $redak["id"] = $row[0];
            $redak["naziv"] = $row[1];
            $redak["oib"]=$row[2];
            $redak["telefon"] = $row[3];
            $redak["datum"] = $row[4];
            $redak["ulica"]=$row[5];
            $redak["grad"]=$row[6];
            $redak["postanski"] = $row[7];
            $redak["logo"] = $row[8];
            $odgovor[] = $redak;
        }
        echo json_encode($odgovor);

    }
