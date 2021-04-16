<?php

    require("../libs/baza.class.php");
    require("../libs/sesija.class.php");
    $db = new Baza();
        $db->spojiDB();
    $user = Sesija::dajKorisnika();
    $sql = "Select id from korisnik where kor_ime = '$user[korisnik]' ";
    $userID = mysqli_fetch_array($db->selectDB($sql))[0];
    if(isset($_POST["brisanjeID"])){
        $id = $_POST["brisanjeID"];
        
        $sql = "delete from zahtjev_rezervacija where id = $id";
        $result = $db->updateDB($sql);
        if($result){
            $odg = "obrisano";
            $sql = "update termin_ronjenja set broj_slobodnih_mjesta = broj_slobodnih_mjesta + 1 
                        where id = $_POST[terminID]";
            $db->updateDB($sql);
            spremiLog($userID, "Obrisi zahtjev id $id", 2);
        }
        else{
            $odg = "nevalja";
        }
    }
    echo json_encode($odg);
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