<?php

    require("../libs/baza.class.php");
    require_once "../libs/sesija.class.php";
    $user = Sesija::dajKorisnika();
    $db = new Baza();
    $db->spojiDB();
    $sql = "Select id from korisnik where kor_ime = '$user[korisnik]' ";
    $userID = mysqli_fetch_array($db->selectDB($sql))[0];

    if(isset($_POST["emailTrajanje"])){
        $emailTrajanje = $_POST["emailTrajanje"];
        $cookieTrajanje = $_POST["cookieTrajanje"];
        $brojPrijava = $_POST["brPrijava"];
        $brZapisa = $_POST["brZapisa"];

        $fp = fopen("../config/config.csv", 'w');
        fwrite($fp, "emailAktivacija;$emailTrajanje");
        fwrite($fp, PHP_EOL);
        fwrite($fp, "cookiePrijava;$cookieTrajanje");
        fwrite($fp, PHP_EOL);
        fwrite($fp, "brojNeuspjelihPrijava;$brojPrijava");
        fwrite($fp, PHP_EOL);
        fwrite($fp, "brojZapisaStr;$brZapisa");
        fwrite($fp, PHP_EOL);
        fclose($fp);
        spremiLog($userID, "Admin action - promjena konfiguracije",3);


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