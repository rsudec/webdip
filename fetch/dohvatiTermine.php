<?php

    require("../libs/baza.class.php");

    //// dohvati termine
    $db = new Baza();
    $db->spojiDB();
    $add= "";
    if(isset($_GET["lokacija"])){
        
        $lokacija = str_replace("_", " ", $_GET["lokacija"]);

        $add = "where l.naziv = '$lokacija' and t.zavrseno = 0 and t.Broj_slobodnih_mjesta > 0";
    }
    else if(isset($_POST["terminZavrseno"])){
        $vrijeme = Vrijeme()->format('Y-m-d H:i:s');
        $sql = "select 
                    tr.id, tr.kraj, lr.naziv 
                from termin_ronjenja as tr
                     left join lokacija_za_ronjenje as lr
                        on tr.id_lokacija = lr.id 
                where 
                    tr.zavrseno = 0 
                    and 
                    tr.kraj < '$vrijeme' ";
        $result = $db->selectDB($sql);
        $odgovor = array();
        while($row  = mysqli_fetch_array($result)){
            $redak["id"] = $row[0];
            $redak["zavrseno"] = $row[1];
            $redak["nazivLokacija"] = $row[2];
            $odgovor[] = $redak;
        }
        echo json_encode($odgovor);
        exit;
    }
    $query = "SELECT t.Id, t.Početak, t.Kraj, t.Zavrseno, t.Broj_slobodnih_mjesta, l.naziv 
            from termin_ronjenja as t
                left join lokacija_za_ronjenje as l
                    on  t.id_lokacija = l.id 
                    $add";

    $odgovor = array();
    $result = $db->selectDB($query);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_row($result)) {
            $redak["id"] = $row[0];
            $redak["početak"] = $row[1];
            $redak["kraj"]=$row[2];
            $redak["zavrseno"] = $row[3];
            $redak["broj_slobodnih"] = $row[4];
            $redak["lokacija"]=$row[5];
            $odgovor[] = $redak;
        }
    }
    

    $db->zatvoriDB();
    header("Content-Type: application/json");
    echo json_encode($odgovor);

    function dohvatiPomakVremena(){
            
        $jsonVrijeme = file_get_contents("http://barka.foi.hr/WebDiP/pomak_vremena/pomak.php?format=json");
        $array = json_decode($jsonVrijeme, true);
        return $array['WebDiP']['vrijeme']['pomak']['brojSati'];
    }
    function Vrijeme(){
        $vrijemeServer = new DateTime();
        $vrijemeVirtual = new DateTime();
        $pomak = dohvatiPomakVremena();
        if($pomak < 0){
            $vrijemeVirtual->modify("$pomak hours");
        }
        else{
            $vrijemeVirtual->modify("+$pomak hours");
        }
        return $vrijemeVirtual;  
}
?>