<?php

    require("../libs/baza.class.php");
    require("../libs/sesija.class.php");

    $user = Sesija::dajKorisnika()["korisnik"];
    $db = new Baza();
    $db->spojiDB();
    $oib= "";
    if(isset($_POST["dodjela"])){
        $sql = "SELECT 
                    rc.id, rc.naziv 
                FROM ronilacki_centar as rc";
        $odgovor = array();
        $result = $db->selectDB($sql);
        while($row = mysqli_fetch_array($result)){
            $redak["id"] = $row[0];
            $redak["naziv"] = $row[1];
            $odgovor[] = $redak;
        }
        $db->zatvoriDB();
        header("Content-Type: application/json");
        echo json_encode($odgovor); 
        exit(); 
    }
    if(isset($_POST["novalokacija"])){
        $sql = "Select id from korisnik where kor_ime = '$user' ";
        $userID = mysqli_fetch_array($db->selectDB($sql))[0];
        $sql = "SELECT 
                    rc.id, rc.naziv 
                FROM ronilacki_centar as rc
                    left join je_moderator as m 
                        on m.ID_centar=rc.ID
                WHERE m.id_korisnik = $userID ";
        $result = $db->selectDB($sql);
        $odgovor = array();

        while($row = mysqli_fetch_array($result)){
            $redak["id"] = $row[0];
            $redak["naziv"] = $row[1];
            $odgovor[] = $redak;
        }
        $db->zatvoriDB();
        header("Content-Type: application/json");
        echo json_encode($odgovor); 
        exit();   
    }
    if(isset($_GET["oib"])){
        $oib = "WHERE OIB = " . $_GET["oib"];
    }
    $query = "SELECT `rc`.`ID`,  `rc`.`Naziv`, `OIB`, `Telefon`, `Datum_osnivanja`, `Ulica`, `grad`.`Naziv`, `grad`.`Postanski_broj`
             FROM `ronilacki_centar` as `rc` 
             LEFT JOIN `grad` on `ID_grad` = `grad`.`ID`
             $oib ";

    $odgovor = array();
    $result = $db->selectDB($query);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_row($result)) {
            $redak["id"] = $row[0];
            $redak["naziv"] = $row[1];
            $redak["oib"]=$row[2];
            $redak["telefon"] = $row[3];
            $redak["datum"] = $row[4];
            $redak["ulica"]=$row[5];
            $redak["grad"]=$row[6];
            $redak["postanski"]=$row[7];
            $odgovor[] = $redak;
        }
    }
    $db->zatvoriDB();
    header("Content-Type: application/json");
    echo json_encode($odgovor);
?>