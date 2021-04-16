   <?php 
    error_reporting(4); // develop
    //error_reporting(0); // deploy

    $putanja = dirname(__FILE__);
    require_once "$putanja/libs/baza.class.php";
    require_once "$putanja/libs/sesija.class.php";
    require_once "$putanja/libs/smarty/libs/Smarty.class.php";

    Sesija::kreirajSesiju();

    $smarty = new Smarty();

    $smarty->setTemplateDir($putanja . DS . 'templates' . DS)
            ->setCompileDir($putanja . DS . 'templates_c' . DS)
            ->setPluginsDir(SMARTY_PLUGINS_DIR)
            ->setCacheDir($putanja . DS . 'cache' . DS)
            ->setConfigDir($putanja . DS . 'configs' . DS);


    

    $smarty->assign('title1', $naslov);
    

    $smarty->display('zaglavlje.tpl');

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
    