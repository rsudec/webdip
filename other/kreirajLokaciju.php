<?php

    require("../libs/baza.class.php");
    require("../libs/sesija.class.php");
    $db = new Baza();
    $db->spojiDB();
    $user = Sesija::dajKorisnika()["korisnik"];

    $sql = "Select id from korisnik where kor_ime = '$user' ";
    $userID = mysqli_fetch_array($db->selectDB($sql))[0];

    if(isset($_POST["idCentar"])){
        $idCentar = $_POST["idCentar"];
        $idVrsta = $_POST["idVrsta"];
        $idGrad = $_POST["idGrad"];
        $nazivLokacija = $_POST["nazivLokacija"];
        $timeLokacija = $_POST["timeLokacija"];
        $dubina = $_POST["dubina"];
        $brojMjesta = $_POST["brojMjesta"];
        $opis = $_POST["opis"];
        

        $sql = "insert into lokacija_za_ronjenje
                    (Naziv, Vrijeme_prijevoza,Dubina, Broj_mjesta, Opis, ID_vrsta_lokacije, ID_centar, ID_grad)
                    values
                    ('$nazivLokacija', '$timeLokacija', $dubina, $brojMjesta, '$opis', $idVrsta, $idCentar,$idGrad )    
                ";
        $res = $db->updateDB($sql);
        if($res){
            spremiLog($userID, "Mod action: Kreiraj lokaciju -> $sql", 3);
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