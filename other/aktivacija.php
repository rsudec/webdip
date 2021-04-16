<?php
  $naslov= "Aktivacija";    
  include_once '../zaglavlje.php';
  $updated = false;
  $istekao = false;
  $poruka = "Uspješno ste se registrirali, ostalo je još samo da aktivirate svoj račun. Dobili ste mail sa linkom potrebnim za aktivaciju.
            Kliknite na link i Vaš će račun biti aktiviran i moći ćete se prijaviti";
    if(!empty($_GET["activate"])){
        
        $db = new Baza();
        $db->spojiDB();
        $sql ="SELECT email, vrijeme_reg, id from korisnik";
        $result = $db->selectDB($sql);
        
        while($email = mysqli_fetch_row($result)){
            if(sha1($email[0]) === $_GET["activate"]){
                $vrijemeRegistracije = new DateTime("$email[1]");
                
                $vrijemeAktivacije = ConfigValue('emailAktivacija');
                if(Vrijeme() > $vrijemeRegistracije->modify("+$vrijemeAktivacije hours")){
                    $istekao =true;
                    break;
                }

                $sql = "update korisnik set aktiviran=1 where email = '$email[0]' ";
                $res = $db->updateDB($sql);
                if($res == 1){
                    spremiLog($email[2], "Aktivacija računa -> $sql", 2);
                    $updated = true;
                    break;
                }
            }
        }
        if($istekao){
            $poruka="URL ISTEKAO";
        }
        else if(!$updated && !$istekao){
            $poruka = "Nevažeći url";
        }
        else if($updated){
            
            $poruka = "Račun aktiviran. <a href='../form/prijava.php'>Prijavite se</a>";
        }
        $db->zatvoriDB();
    }
    

    $smarty->assign('poruka', $poruka);
    $smarty->display('aktivacija.tpl');
    function ConfigValue($trazeno){
        $csv = fopen("../config/config.csv", "r");
        while($red = fgetcsv($csv, 100, ";")){
            if($red[0] == $trazeno){
                    return $red[1];
            }        
    }
}