<?php

    require("../libs/baza.class.php");
    require("../libs/sesija.class.php");
    $db = new Baza();
    $db->spojiDB();
    $user = Sesija::dajKorisnika()["korisnik"];

    

    if(isset($_POST["nazivCentar"])){
        $sql = "Select id from korisnik where kor_ime = '$user' ";
        $userID = mysqli_fetch_array($db->selectDB($sql))[0];
        
        $naziv = $_POST["nazivCentar"];
        $oib = $_POST["oibCentar"];
        $tel = $_POST["telCentar"];
        $date = $_POST["dateCentar"];
        $addr = $_POST["adrCentar"];
        $grad = $_POST["gradCentar"];

        //echo $naziv ." ". $oib ." ". $tel ." ".$date." ".$addr." ".$grad;
        $sql = "insert into 
                    ronilacki_centar
                        (Naziv, Oib, Telefon, Datum_osnivanja, Ulica, ID_grad)
                    values
                    ('$naziv', '$oib', '$tel', '$date', '$addr', $grad )";
        $res = $db->updateDB($sql);
        if($res){
            spremiLog($userID, "Admin action: Kreiraj centar", 3);
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