<?php

    require("../libs/baza.class.php");
    require("../libs/sesija.class.php");

    $user = Sesija::dajKorisnika();

    $db = new Baza();
    $db->spojiDB();
    if(isset($_POST["terminID"])){
        $terminID= $_POST["terminID"];
        
        $sql = "select id from korisnik where kor_ime = '$user[korisnik]'";
        $res = $db->selectDB($sql);
        $userID = mysqli_fetch_array($res)[0];
        
        $sql = "update termin_ronjenja set zavrseno = 1 where id = $terminID";
        if($res = $db->updateDB($sql)){
            spremiLog($userID, "Mod Action : postaviTerminNaZavrseno -> $sql", 3);
            echo json_encode('Uspjeh');

        };
    }
    $db->zatvoriDB();
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