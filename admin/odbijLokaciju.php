<?php
    require_once "../libs/baza.class.php";
    require_once "../libs/sesija.class.php";
    $user = Sesija::dajKorisnika();

    $db = new Baza();
    $db->spojiDB();

    
    if(isset($_POST["odbijID"])){
        $sql = "Select id from korisnik where kor_ime = '$user[korisnik]' ";
        $userID = mysqli_fetch_array($db->selectDB($sql))[0];
        $odbijID = $_POST["odbijID"];
        $sad = Vrijeme()->format('Y-m-d H:i:s');
        $sql = "delete from lokacija_za_ronjenje 
                where id = $odbijID";

        $db->updateDB($sql);
        spremiLog($userID, "Admin action - Odbij lokaciju $odbijID",2);
        echo 'odbijeno';
    }
    $db->zatvoriDB();

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