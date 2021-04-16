<?php
    require("../libs/baza.class.php");
    $db = new Baza();
        $db->spojiDB();
    if(isset($_GET['rowid'])){
        $rowid = $_GET['rowid'];
        $rowperpage = $_GET['rowperpage'];
        $sql = "select count(id) from lokacija_za_ronjenje";
        $result = $db->selectDB($sql);
        $ukupnoZapisa = mysqli_fetch_array($result)[0];

        $sql = "SELECT `lc`.`ID`,  `lc`.`Naziv`, `Vrijeme_prijevoza`, `Dubina`, 
                    `Broj_mjesta`, `lc`.`Opis`, `vrsta`.`Vrsta_lokacije`, `rc`.`Naziv`, `grad`.`Naziv` 
        FROM `lokacija_za_ronjenje` as `lc` 
        LEFT JOIN `vrsta_ronilacke_lokacije` as `vrsta` ON `lc`.`ID_vrsta_lokacije` = `vrsta`.`ID` 
        LEFT JOIN `ronilacki_centar` as `rc` ON `lc`.`ID_centar` = `rc`.`ID` 
        LEFT JOIN `grad` ON `lc`.`ID_grad` = `grad`.`ID`
        LIMIT $rowid, $rowperpage";

        
        $result = $db->selectDB($sql);

        $odgovor = array();
        $redak["ukupno"] = $ukupnoZapisa;
        $odgovor[] = $redak;
        while($row = mysqli_fetch_array($result)){
            $redak["id"] = $row[0];
            $redak["naziv"] = $row[1];
            $redak["vrijeme"]=$row[2];
            $redak["dubina"] = $row[3];
            $redak["brojMjesta"] = $row[4];
            $redak["opis"]=$row[5];
            $redak["vrsta"]=$row[6];
            $redak["centar"]=$row[7];
            $redak["grad"]=$row[8];

            $sql = "Select slika from slike where ID_lokacije = $redak[id]";
            $slike = $db->selectDB($sql);
            $galerija = "";
            while(list($slika) = mysqli_fetch_array($slike)){
                $galerija .= "<img src='../assets/slike/$slika' alt='$slika'>";
            };

            $redak["slike"]= $galerija;
            $odgovor[] = $redak;
        }
        echo json_encode($odgovor);

}