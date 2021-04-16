<?php

    require("../libs/baza.class.php");
    require("../libs/sesija.class.php");
    $db = new Baza();
    $db->spojiDB();
    $user = Sesija::dajKorisnika()["korisnik"];

    $sql = "Select id from korisnik where kor_ime = '$user' ";
    $userID = mysqli_fetch_array($db->selectDB($sql))[0];

    if(isset($_POST["idLok"])){
        $idLokacije = $_POST["idLok"];
        $početak = $_POST["početak"];
        $kraj = $_POST["kraj"];


        $sql = "select broj_mjesta from lokacija_za_ronjenje where id = $idLokacije";
        $brojMjesta = mysqli_fetch_array($db->selectDB($sql))[0];

        $sql = "insert into
                    termin_ronjenja
                    (početak, kraj, broj_slobodnih_mjesta, id_lokacija)
                    values
                    ('$početak', '$kraj', $brojMjesta, $idLokacije )";
        $db->updateDB($sql);
        spremiLog($userID, "Mod action: Kreiraj Termin -> $sql", 3);
    }
    function spremiLog($user, $vrijednost, $tip){
        $db = new Baza();
        $db->spojiDB();
        $sada = Vrijeme()->format('Y-m-d H:i:s');
        $sql =  "Insert into log (vrijednost, vrijeme, id_korisnik, id_tip) values
                    ('$vrijednost', '$sada', $user, $tip) ";
        $db->updateDB($sql);
        $db->zatvoriDB();
    }
    function dohvatiPomakVremena(){
            
        $jsonVrijeme = file_get_contents("http://barka.foi.hr/WebDiP/pomak_vremena/pomak.php?format=json");
        $array = json_decode($jsonVrijeme, true);
        return $array['WebDiP']['vrijeme']['pomak']['brojSati'];
    }
    function Vrijeme(){
            
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