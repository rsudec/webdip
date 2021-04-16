<?php 
    $naslov= "Admin panel";    
    include_once '../zaglavlje.php';
    include_once '../podnozje.php';

    if($_SESSION["uloga"] != 3 || empty($_SESSION["korisnik"])){
        header("Location : ../index.php");
    }

    $registered = "";
    $moderator = "";
    $administrator = "";

    //POSTAVI NAVIGACIJSKI
        $logged="";
        $uloga = "";
        if($_SESSION["uloga"]  >= 1 ){
            $uloga = "
            <li class='nav-ul-li'><a class='nav-ul-li-a' href='profil.php'>profil</a></li>"; 
            if($_SESSION["uloga"]  == 3 ){
                $uloga .= "<li class='nav-ul-li'><a class='nav-ul-li-a' href='adminP.php'>admin panel</a></li>";
            }
        }
        $logged = "<li class='nav-ul-li'><a class='nav-ul-li-a ' href='odjava.php'>odjava</a></li>";
        
        $smarty->assign('role', $uloga);
        $smarty->assign('logged', $logged);

        $user= $_SESSION["korisnik"];
        
        $smarty->assign('user', $user);
        $smarty->assign('uloga', $uloga);

        $smarty->display('adminP.tpl');
        $smarty->display('podnozje.tpl');
    ?>