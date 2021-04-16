<?php

    require("../libs/baza.class.php");
    require("../libs/sesija.class.php");
    $db = new Baza();
    $db->spojiDB();
    $user = Sesija::dajKorisnika()["korisnik"];

    $sql = "Select id from korisnik where kor_ime = '$user'";
    
    if(!empty($_FILES["photos"]["name"])){    
        
        $userfile = $_FILES['photos']['tmp_name'][0];
        $userfile_name = $_FILES['photos']['name'][0];
        $userfile_size = $_FILES['photos']['size'][0];
        $userfile_type = $_FILES['photos']['type'][0];
        $userfile_error = $_FILES['photos']['error'][0];
        $datoteka_za_upload = $userfile_name;
        $regex_pattern = "/.{20,}/";
        if(preg_match($regex_pattern, $userfile_name)){
            echo "Naziv datoteke max 20 slova ili brojeva";
            exit;
        }
        if ($userfile_type == "image/jpeg" || $userfile_type == "image/png" || $userfile_type == "image/jpg") {
            if($userfile_size < 250000){
                $upfile = '../assets/slike/' . $userfile_name;
            }
            else{
                echo "Prevelika slika";
                exit;
            }
        }
        else{
            echo "Datoteka nije slika";
            exit;
        }
        if (is_uploaded_file($userfile)) {
            if (!move_uploaded_file($userfile, $upfile)) {
                echo 'Problem: nije moguće prenijeti datoteku na odredište';
                exit;
            }
            echo 'Uspjeh';
            $userID = mysqli_fetch_array($db->selectDB($sql))[0];  
            $sql = "insert into slike (Slika, opis_slike, datum_upload, id_lokacije,id_korisnik)
                    values 
                    ('$userfile_name',
                    '$_GET[opis]', 
                    '".Vrijeme()->format("Y-m-d H:i:s"). "',
                    $_GET[id],
                    $userID )";
            $db->updateDB($sql);
            spremiLog($userID, "Upload slike -> $userfile_name", 2);
            $db->zatvoriDB();

        } else {
            echo 'Problem: mogući napad prijenosom. Datoteka: ' . $userfile_name;
            exit;
        }
        
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
function spremiLog($user, $vrijednost, $tip){
    $db = new Baza();
    $db->spojiDB();
    $sada = Vrijeme()->format('Y-m-d H:i:s');
    $sql =  "Insert into log (vrijednost, vrijeme, id_korisnik, id_tip) values
                ('$vrijednost', '$sada', $user, $tip) ";
    $db->updateDB($sql);
    $db->zatvoriDB();
}