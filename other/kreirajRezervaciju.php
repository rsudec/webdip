<?php

    require("../libs/baza.class.php");
    require("../libs/sesija.class.php");

    $user = Sesija::dajKorisnika();

    $db = new Baza();
    $db->spojiDB();
    if(isset($_POST["terminID"])){
        $terminID= $_POST["terminID"];
        $dubina = $_POST["dubina"];

        
        $sql = "select id from korisnik where kor_ime = '$user[korisnik]'";
        $res = $db->selectDB($sql);
        $userID = mysqli_fetch_array($res)[0];
        
        $sql = "select count(id) from zahtjev_rezervacija where id_termin = $terminID AND id_korisnik = $userID ";
        $resIma = mysqli_fetch_array($db->selectDB($sql))[0];
        if($resIma == 0){
            $sql = "insert into zahtjev_rezervacija
                (Max_dubina, ID_korisnik, ID_termin)
                values
                ($dubina, $userID, $terminID);";
            $res = $db->updateDB($sql);
            echo $userID;
            spremiLog($userID, "Kreiraj rezervaciju -> $sql", 3);
            echo 'Insert';
        }
        else{
            echo "Greška";
        }
        
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
