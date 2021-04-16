<?php


    require("../libs/baza.class.php");


    $db = new Baza();
    $db->spojiDB();
    if(isset($_POST["blokirani"])){
        $query = "SELECT id, kor_ime FROM korisnik WHERE blokiran = 1 and aktiviran = 1 ";
        $odgovor = array();
        $result = $db->selectDB($query);
        if (mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_row($result)) {
                $redak["id"] = $row[0];
                $redak["korime"] = $row[1];
                $odgovor[] = $redak;
            }
        }
        $db->zatvoriDB();
        header("Content-Type: application/json");
        echo json_encode($odgovor);
    }
    if(isset($_POST["otključani"])){
        $query = "SELECT id, kor_ime FROM korisnik WHERE blokiran = 0 and aktiviran = 1 ";
        $odgovor = array();
        $result = $db->selectDB($query);
        if (mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_row($result)) {
                $redak["id"] = $row[0];
                $redak["korime"] = $row[1];
                $odgovor[] = $redak;
            }
        }
        $db->zatvoriDB();
        header("Content-Type: application/json");
        echo json_encode($odgovor);
    }