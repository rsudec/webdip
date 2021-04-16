<?php
    $naslov= "Prijava";    
    include_once '../zaglavlje.php';
    $loginPoruka = "";
    if(!empty($_COOKIE["user"])){
        $cookieUser = $_COOKIE["user"];        
    }
    if(isset($_POST["submit"])){
        $username = $_POST["korime"];
        $lozinka = $_POST["lozinka"];
        $lozinka_hash = sha($lozinka, $username);        
        $sql = "SELECT id, kor_ime, lozinka_hash, blokiran, aktiviran, id_uloga
         from korisnik 
         where kor_ime = '$username' and Lozinka_hash = '$lozinka_hash'";
        $baza = new Baza();
        $baza->spojiDB();
        $log_user="";
        $log_hash="";
        $log_uloga="";
        $result = $baza->selectDB($sql);
        list($log_id, $log_user, $log_hash, $log_blok, $log_akt, $log_uloga) = mysqli_fetch_array($result);
        
        $baza->zatvoriDB();
        if(isset($log_user) && isset($log_hash) && $log_blok == 0 && $log_akt == 1){

            Sesija::kreirajSesiju();
            Sesija::kreirajKorisnika($log_user, $log_uloga);
            spremiLog($log_id, "Prijava", 1);
            $time = Vrijeme();
            $secondsNow = $time->getTimestamp();
            $trajanjeCookies = ConfigValue('cookiePrijava');

            setcookie("user", "$log_user" , $secondsNow + 3600*$trajanjeCookies);
            header("Location: ../index.php");
        }
        else{
            $log_user = $_POST["korime"];
            $brojMaxPrijava = ConfigValue('brojNeuspjelihPrijava');
            
            $db = new Baza();
            $db->spojiDB();
            $sql ="select id, neuspjela_prijava from korisnik where kor_ime = '$log_user' ";
            $result = $db->selectDB($sql);
            
            $brojPrijava = mysqli_fetch_row($result);
            $brojPrijavaDosad = $brojPrijava[1];
            $log_id= $brojPrijava[0];
            if($brojPrijavaDosad >= $brojMaxPrijava){
                echo "$log_id";
                $sql = "update korisnik set blokiran = 1, neuspjela_prijava = 0 where kor_ime = '$log_user' ";
                $result = $db->updateDB($sql);
                if($result == 1){
                    
                    spremiLog($log_id, "Blokirao račun", 1);
                    $loginPoruka = "Blokirali ste račun";
                    $db->zatvoriDB();
                }
            }
            else{
                $brojPrijavaDosad += 1;
                $sql = "update korisnik set neuspjela_prijava = $brojPrijavaDosad where kor_ime = '$log_user' ";
                $result = $db->updateDB($sql);
                $db->zatvoriDB();
                if($result == 1){
                    spremiLog($log_id, "Pokušaj prijave", 1);
                    $loginPoruka = "Neuspješna prijava, pokušaj ponovo.";
                }
            }
            
        }
        
    }
    $smarty->assign('cookieUser', $cookieUser);
    $smarty->assign('porukaPrijava', $loginPoruka);
    $smarty->display('prijava.tpl');

    
    function sha($lozinka, $username){
        $salt = sha1($username);
        $kript =  sha1($salt . '--' . $lozinka);
        return $kript;
    }
    function ConfigValue($trazeno){
        $csv = fopen("../config/config.csv", "r");
        while($red = fgetcsv($csv, 100, ";")){
            if($red[0] == $trazeno){
                    return $red[1];
            }        
        }
    }