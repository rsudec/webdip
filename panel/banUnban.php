<?php
    require("../libs/baza.class.php");
    require_once "../libs/sesija.class.php";
    $user = Sesija::dajKorisnika();
    $db = new Baza();
    $db->spojiDB();
    $sql = "Select id from korisnik where kor_ime = '$user[korisnik]' ";
    $userID = mysqli_fetch_array($db->selectDB($sql))[0];
    
    if($_POST["action"] == 'ban'){
        $banId = $_POST["idBan"];
        $query = "update korisnik set blokiran = 1 where id = $banId ";
        $odgovor = array();
        $result = $db->selectDB($query);
        if($result){
            spremiLog($userID, "Admin action - Blokiraj korisnika $banId",2);
            echo 'Uspjeh';
            $db->zatvoriDB();
            exit;
        }
    }
    if($_POST["action"] == 'unban'){
        $unbanId= $_POST["idUnban"];
        $query = "update korisnik set blokiran = 0 where id = $unbanId ";
        $odgovor = array();
        $result = $db->selectDB($query);
        if($result){
            spremiLog($userID, "Admin action - odblokiraj korisnika  $unbanId",2);
            echo 'Uspjeh';
            $db->zatvoriDB();
            exit;
        }
        $db->zatvoriDB();
        header("Content-Type: application/json");
    }

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
function spremiLog($user, $vrijednost, $tip){
    $db = new Baza();
    $db->spojiDB();
    $sada = Vrijeme()->format('Y-m-d H:i:s');
    $sql =  "Insert into log (vrijednost, vrijeme, id_korisnik, id_tip) values
                ('$vrijednost', '$sada', $user, $tip) ";
    echo $sql;
    $db->updateDB($sql);
    $db->zatvoriDB();
}