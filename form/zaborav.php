<?php
    $naslov= "Zaboravljena lozinka";    
    include_once '../zaglavlje.php';
    $porukaForgot ="";
    
    if(isset($_POST["submit"])){
        $email = $_POST["email"];

        $db = new Baza();
        $db->spojiDB();
        $sql = "select id, kor_ime, email from korisnik where email = '$email'";
        $result = $db->selectDB($sql);
        $row = mysqli_fetch_row($result);
        
        if(is_null($row)){
            $porukaForgot = "Email ne postoji";
        }
        else{
            $pass = substr(md5(rand()), 0, 8);
            $pass_hash = sha($pass, $row[1]);
            $mail_to = $row[2];
            $mail_from = "From: ronilacki_centar@RobertSudec.projekt\r\n" . "MIME-version: 1.0\r\n" . "Content-Type: text/html; charset=utf-8\r\n";
            $mail_subject = "Nova lozinka";
            $mail_body = "<h3>Nova lozinka za Vaš račun</h3>
                        <p>Poštovani, šaljemo Vam novu lozinku za Vaš račun</p>
                        <h4>Lozinka : $pass</h4>
                        <a href='http://barka.foi.hr/WebDiP/2018_projekti/WebDiP2018x130/form/prijava.php'> <span style='font-weight:bold; font-size:16pt'>Prijavi se</span></a>
                        <h5>Lp, Robert Sudec</h5>";
            $sql = "update korisnik set lozinka = '$pass', lozinka_hash = '$pass_hash' where email = '$row[2]' ";
            $result = $db->updateDB($sql);
            spremiLog($row[0], "Nova lozinka", 3);

            mail($mail_to, $mail_subject, $mail_body, $mail_from);
            $porukaForgot = "Na Vaš e-mail poslana je nova lozinka";

            
        }
        $db->zatvoriDB();        
    }
   

    
    $smarty->assign('porukaForgot', $porukaForgot);
    $smarty->display('zaboravljenaLoz.tpl');

    
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