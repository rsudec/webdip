<?php

    require("../libs/baza.class.php");
    require("../libs/sesija.class.php");
    $db = new Baza();
    $db->spojiDB();
    $user = Sesija::dajKorisnika()["korisnik"];

    

    if(isset($_POST["create"])){
        $sql = "Select id from korisnik where kor_ime = '$user' ";
        $userID = mysqli_fetch_array($db->selectDB($sql))[0];
        
        $vrsta = $_POST["vrsta"];
        $opis = $_POST["opis"];

        $sql = "insert into 
                    vrsta_ronilacke_lokacije
                        (vrsta_lokacije, opis)
                    values
                    ('$vrsta', '$opis')";
        $res = $db->updateDB($sql);
        if($res){
            spremiLog($userID, "Admin action: Kreiraj vrstu lokacije", 3);
            echo "Uspjeh";
        }
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