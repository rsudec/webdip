<?php
  $naslov= "Registracija";    
  include_once '../zaglavlje.php';
  $emailCheck ="";
  define('SITE_KEY', '6LdG_KYUAAAAAAgyBsDTRH53vPBgok0Q02WcGMfh');
  define('SECRET_KEY', '6LdG_KYUAAAAANkAjHvfOG99BmSzy9gHhBPNobDx');
  $CaptchaMsg="";
  $smarty->assign('site_key', SITE_KEY);
  $smarty->assign('secret_key', SECRET_KEY);

  $Captcha = false;

  if(isset($_POST["email"])){
    function getCaptcha($secretKey){
      $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRET_KEY."&response={$secretKey}");
      $return = json_decode($Response);
      return $return;
    }
    $return = getCaptcha($_POST["g-recaptcha-response"]);
    if($return->success == true && $return->score > 0.5){
      $Captcha= true;
    }
    else{
      $Captcha = false;
      $CaptchaMsg = "ROBOT ALERT";
    }
    $email = $_POST["email"];
    $sql = "Select email from Korisnik where email='$email' ";
    $db = new Baza();
    $db->spojiDB();
    $result = $db->selectDB($sql);
    $emailExists = mysqli_fetch_array($result)[0];
    $db->zatvoriDB();
    $pattern = "/\b^([a-zA-Z0-9])+(\.{1}[a-zA-Z0-9]+)*@([a-zA-Z0-9]{2,}(\.)?)+\.[a-zA-Z0-9]{2,}$\b/";
    
    if(strlen($_POST["korime"]) > 4 
      && $_POST["lozinka"] == $_POST["relozinka"] 
      && strlen($_POST["lozinka"]) > 5
      &&  preg_match($pattern, $_POST["email"])
      &&  empty($emailExists)
      && $Captcha){

        $ime = $_POST["ime"];
        $prezime = $_POST["prezime"];
        $username= $_POST["korime"];
        $telefon = $_POST["telefon"];
        $email = $_POST["email"];
        $lozinka = $_POST["lozinka"];
        $lozinka_hash = sha($lozinka, $username);
        $sql = "INSERT into korisnik (
          ime,
          prezime,
          kor_ime,
          email,
          telefon,
          lozinka,
          lozinka_hash,
          vrijeme_reg
          ) values (
          '$ime',
          '$prezime',
          '$username',
          '$email',
          '$telefon',
          '$lozinka',
          '$lozinka_hash',
          now()
          );";

        $db = new Baza();
        $db->spojiDB();
        $result = $db->updateDB($sql);
        if($result == 1){
          $get = sha1($email);
          $mail_to = $email;
          $mail_from = "From: ronilacki_centar@RobertSudec.projekt\r\n" . "MIME-version: 1.0\r\n" . "Content-Type: text/html; charset=utf-8\r\n";
          $mail_subject = "Aktivacija korisnickog racuna";
          $mail_body = "<h3>Aktivacija računa za ronilački centar</h3>
                        <p>Poštovani, kliknite na sljedeći link kako bi aktivirali svoj račun</p>
                        <a href='http://barka.foi.hr/WebDiP/2018_projekti/WebDiP2018x130/other/aktivacija.php?activate=$get'> 
                        <span style='font-weight:bold; font-size:16pt'>Aktiviraj račun</span></a>
                        <h5>Lp, Robert Sudec</h5>";
        mail($mail_to, $mail_subject, $mail_body, $mail_from);
                        
          $sql = "select id from korisnik where email = '$email'";
          $result = $db->selectDB($sql);
          $user_id = mysqli_fetch_array($result)[0];
          
          spremiLog($user_id, "Registracija", 2);
          header("Location: ../other/aktivacija.php");
          
        }


        } 
        else if(empty($emailExists)){
          $emailCheck = "<p class='registrationErr' style='display:block'>
                          Postoji račun s ovom e-mail adresom
                          </p>";
        }
  }
  $smarty->assign('errCaptcha', $CaptchaMsg);
  //$smarty->assign('SITEKEY', "6Lf7-aYUAAAAAFhULl7ID8YYqRp0AMcU66z6lwig");
  //$smarty->assign('SECRETKEY', $SECRET);
  $smarty->assign('emailCheck', $emailCheck);
  $smarty->display('registracija.tpl');

  function sha($lozinka, $username){
    $salt = sha1($username);
    $kript =  sha1($salt . '--' . $lozinka);
    return $kript;
}