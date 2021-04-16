<?php

    require("../libs/baza.class.php");


    $db = new Baza();
    $db->spojiDB();
    $naziv= "";
    $query = "SELECT * FROM `vrsta_ronilacke_lokacije` ";

    $odgovor = array();
    $result = $db->selectDB($query);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_row($result)) {
            $redak["id"] = $row[0];
            $redak["vrsta"] = $row[1];
            $odgovor[] = $redak;
        }
    }
    $db->zatvoriDB();
    header("Content-Type: application/json");
    echo json_encode($odgovor);
?>