<?php

    require("../libs/baza.class.php");


    $db = new Baza();
    $db->spojiDB();
    if(isset($_POST["dodjela"])){
        $sql = "select id, kor_ime from korisnik where id_uloga >= 2";
        $odgovor = array();
        $result = $db->selectDB($sql);
        if (mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_row($result)) {
                $redak["id"] = $row[0];
                $redak["korime"] = $row[1];
                $odgovor[] = $redak;
            }
        }
        header("Content-Type: application/json");
        echo json_encode($odgovor);
        exit();
    }
    if(isset($_GET["user"])){
        $user = $_GET["user"];
        $query = "SELECT kor_ime FROM korisnik WHERE kor_ime = '$user' ";
    }
    else{
        $query = "SELECT kor_ime FROM korisnik";
    }

    $odgovor = array();
    $result = $db->selectDB($query);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_row($result)) {
            $user = $row[0];
            $odgovor[] = $user;
        }
    }
    $db->zatvoriDB();
    header("Content-Type: application/json");
    echo json_encode($odgovor);
?>