<?php
    require("../libs/baza.class.php");


    $db = new Baza();
    $db->spojiDB();
    $query = "SELECT Ime, Prezime, kor_ime, lozinka, lozinka_hash
            FROM korisnik ";

    $odgovor = array();
    $result = $db->selectDB($query);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_row($result)) {
            $redak["Name"] = $row[0];
            $redak["Surname"] = $row[1];
            $redak["Username"] = $row[2];
            $redak["Password"] = $row[3];
            $redak["Password HASH"]=$row[4];
            $odgovor[] = $redak;
        }
    }
    $db->zatvoriDB();
    header("Content-Type: application/json");
    echo json_encode($odgovor);