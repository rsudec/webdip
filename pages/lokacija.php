<?php

    $naslov= "Ronilačka lokacija";    
    include_once '../zaglavlje.php';
    include_once '../podnozje.php';
    ///////////////////////////////////////////////////////////////
    //POSTAVI NAVIGACIJSKI                     
    //////////////////////////////////////////////////////////////
        $logged="";
        $uloga = "";
        if(empty($_SESSION["korisnik"])){
            $logged = "<li class='nav-ul-li'><a class='nav-ul-li-a' href='../form/prijava.php'>prijava</a></li>
            <li class='nav-ul-li'><a class='nav-ul-li-a' href='../form/registracija.php'>registracija</a></li>";
        }
        else{
            if($_SESSION["uloga"]  >= 1 ){
                $uloga = "
                <li class='nav-ul-li'><a class='nav-ul-li-a' href='../form/profil.php'>profil</a></li>"; 
                if($_SESSION["uloga"]  == 3 ){
                    $uloga .= "<li class='nav-ul-li'><a class='nav-ul-li-a' href='../form/adminP.php'>admin panel</a></li>";
                }
            }
            $logged = "<li class='nav-ul-li'><a class='nav-ul-li-a' href='../form/odjava.php'>odjava</a></li>";
        }
        $smarty->assign('role', $uloga);
        $smarty->assign('logged', $logged);
    ////////////////////////////////////////////////////////////////
    //DOHVATI LOKACIJE
    //////////////////////////////////////////////////////////////
        $db = new Baza();
        $db->spojiDB();


        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $sql= "SELECT `lc`.`ID`,  `lc`.`Naziv`, `Vrijeme_prijevoza`, `Dubina`, `Broj_mjesta`, `lc`.`Opis`, `vrsta`.`Vrsta_lokacije`, `rc`.`Naziv`, `grad`.`Naziv` 
            FROM `lokacija_za_ronjenje` as `lc` 
            LEFT JOIN `vrsta_ronilacke_lokacije` as `vrsta` ON `lc`.`ID_vrsta_lokacije` = `vrsta`.`ID` 
            LEFT JOIN `ronilacki_centar` as `rc` ON `lc`.`ID_centar` = `rc`.`ID` 
            LEFT JOIN `grad` ON `lc`.`ID_grad` = `grad`.`ID`
            WHERE  `lc`.`ID` = $id ";
        }
        else{
            $sql= "SELECT `lc`.`ID`,  `lc`.`Naziv`, `Vrijeme_prijevoza`, `Dubina`, `Broj_mjesta`, `lc`.`Opis`, `vrsta`.`Vrsta_lokacije`, `rc`.`Naziv`, `grad`.`Naziv` 
            FROM `lokacija_za_ronjenje` as `lc` 
            LEFT JOIN `vrsta_ronilacke_lokacije` as `vrsta` ON `lc`.`ID_vrsta_lokacije` = `vrsta`.`ID` 
            LEFT JOIN `ronilacki_centar` as `rc` ON `lc`.`ID_centar` = `rc`.`ID` 
            LEFT JOIN `grad` ON `lc`.`ID_grad` = `grad`.`ID` 
            ";
        }
        
        $result = $db->selectDB($sql);
        $lokacije = " ";
        while(list($id, $naziv, $vrijeme, $dubina, $brojMjesta, $opis, $vrsta, $centar, $grad) = mysqli_fetch_array($result)){
            $sql = "Select slika from slike where ID_lokacije = $id";
            $slike = $db->selectDB($sql);
            $galerija = "";
            while(list($slika) = mysqli_fetch_array($slike)){
                $galerija .= "<img src='../assets/slike/$slika' alt='$slika'>";
            };
            $row = " <div class='centarMain'> 
                                <h3>Ronilačka lokacija - $naziv </h3>
                                <div class='info'> 
                                    <ul>
                                        <li> Vrijeme prijevoza: $vrijeme </li>
                                        <li> Dubina: $dubina </li>
                                        <li> Broj mjesta: $brojMjesta </li>
                                        <li> Opis: $opis </li>
                                        <li> Vrsta lokacije: $vrsta </li>
                                        <li> Ronilački centar: $centar </li>
                                        <li> Grad: $grad </li>
                                    </ul>
                                </div>
                        <div class='gallery'>
                            $galerija
                        </div>
                    </div>";
            $lokacije .= $row;
        };
        $db->zatvoriDB();
        
    
    $smarty->assign('lokacije', $lokacije);


    $smarty->display('lokacija.tpl');
    $smarty->display('podnozje.tpl');

    function ConfigValue($trazeno){
        $csv = fopen("../config/config.csv", "r");
        while($red = fgetcsv($csv, 100, ";")){
            if($red[0] == $trazeno){
                    return $red[1];
            }        
        }
    }