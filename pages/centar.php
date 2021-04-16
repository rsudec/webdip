<?php

    $naslov= "Ronilački centar";    
    include_once '../zaglavlje.php';
    include_once '../podnozje.php';
    //////////////////////
    //POSTAVI NAVIGACIJSKI
    //////////////////////
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

    //////////////////////
    //DOHVATI RONILAČKE CENTER
    //////////////////////     
        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $sql = "SELECT `rc`.`ID`, `rc`.`Naziv`, `OIB`, `Telefon`, `Datum_osnivanja`, `Ulica`, `grad`.`Naziv`, `grad`.`Postanski_broj` 
            FROM `ronilacki_centar` as `rc` 
            LEFT JOIN `grad` on `ID_grad` = `grad`.`ID` 
            WHERE `rc`.`ID` = $id";
        }
        else{
            $sql = "SELECT `rc`.`ID`, `rc`.`Naziv`, `OIB`, `Telefon`, `Datum_osnivanja`, `Ulica`, `grad`.`Naziv`, `grad`.`Postanski_broj`
                    FROM `ronilacki_centar` as `rc` 
                    LEFT JOIN `grad` on `ID_grad` = `grad`.`ID` ";
        }

        $db = new Baza();
        $db->spojiDB();
        $result = $db->selectDB($sql);
        
        $centri = "";
        while(list($id, $naziv, $oib, $telefon, $datum, $ulica, $grad, $postanski) = mysqli_fetch_array($result)){
            $centri .= "<div class='centarMain'>
                            <h3>Ronilački centar - $naziv </h3>
                            <div class='info'>
                                <ul>    
                                    <li> OIB: $oib</li>
                                    <li> Telefon: $telefon </li>
                                    <li> Datum osnivanja: $datum </li>
                                    <li> Adresa: $ulica </li>
                                    <li> Grad: $grad, $postanski </li>
                                </ul>
                            </div>
                            <div class='logo'>
                                <img src='../assets/centarlogoSVG.svg' alt='logo'>
                            </div>
                        </div>";
        };
        $db->zatvoriDB();
        $smarty->assign('centri', $centri);

    $smarty->display('centar.tpl');
    $smarty->display('podnozje.tpl');

    