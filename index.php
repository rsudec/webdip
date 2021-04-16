<?php
    $naslov= "Index";    
    include_once 'zaglavlje.php';
    include_once 'podnozje.php';

    //POSTAVI NAVIGACIJSKI
        $logged="";
        $uloga = "";
        if(empty($_SESSION["korisnik"])){
            $logged = "<li class='nav-ul-li'><a class='nav-ul-li-a-ind' href='form/prijava.php'>prijava</a></li>
            <li class='nav-ul-li'><a class='nav-ul-li-a-ind' href='form/registracija.php'>registracija</a></li>";
        }

        else{
            if($_SESSION["uloga"]  >= 1 ){
                $uloga = "
                <li class='nav-ul-li'><a class='nav-ul-li-a-ind' href='form/profil.php'>profil</a></li>"; 
                if($_SESSION["uloga"]  == 3 ){
                    $uloga .= "<li class='nav-ul-li'><a class='nav-ul-li-a-ind' href='form/adminP.php'>admin panel</a></li>";
                }
            }

            $logged = "<li class='nav-ul-li'><a class='nav-ul-li-a-ind' href='form/odjava.php'>odjava</a></li>";
        }
        $smarty->assign('role', $uloga);
        $smarty->assign('logged', $logged);
    
        


   

    $smarty->display('index.tpl');
    

    $smarty->display('podnozje.tpl');


    