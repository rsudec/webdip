<?php
 require("../libs/baza.class.php");
 require("../libs/sesija.class.php");
 $user = Sesija::dajKorisnika()["korisnik"];
 $db = new Baza();
 $db->spojiDB();
 if(isset($_POST["dodjela"])){
    $sql = "Select id from korisnik where kor_ime = '$user' ";
    $userID = mysqli_fetch_array($db->selectDB($sql))[0];

     $idCentar = $_POST["centar"];
     $idUser = $_POST["user"];
     $sql = "insert into je_moderator (id_korisnik, id_centar) values ($idUser, $idCentar)";

     $result = $db->selectDB($sql);
     if($result){
        header("Content-Type: application/json");
        spremiLog($userID, "Admin action: Dodjela moderatora -> $sql", 3);

        echo json_encode($result);

        exit();
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