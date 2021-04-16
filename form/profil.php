<?php
    $naslov= "Profil";    
    include_once '../zaglavlje.php';
    include_once '../podnozje.php';

    if(empty($_SESSION["korisnik"])){
        header("Location : ../index.php");
    }

    $registered = "";
    $moderator = "";
    $administrator = "";

    //POSTAVI NAVIGACIJSKI
        $logged="";
        $uloga = "";
        if(empty($_SESSION["korisnik"])){
            $logged = "<li class='nav-ul-li'><a class='nav-ul-li-a' href='prijava.php'>prijava</a></li>
            <li class='nav-ul-li'><a class='nav-ul-li-a' href='registracija.php'>registracija</a></li>";
            
        }
        else{
            if($_SESSION["uloga"]  >= 1 ){
                $uloga = "
                <li class='nav-ul-li'><a class='nav-ul-li-a' href='profil.php'>profil</a></li>"; 
                if($_SESSION["uloga"]  == 3 ){
                    $uloga .= "<li class='nav-ul-li'><a class='nav-ul-li-a' href='adminP.php'>admin panel</a></li>";
                }
            }
            $logged = "<li class='nav-ul-li'><a class='nav-ul-li-a  ' href='odjava.php'>odjava</a></li>";
        }
        $smarty->assign('role', $uloga);
        $smarty->assign('logged', $logged);

    /////////////////////////////////////////////////////////////////////////////////////////////
    // PREPOZNAJ ULOGU
        if(!empty($_SESSION["korisnik"])){
            if($_SESSION["uloga"] >= 1){
                $uloga = "registriran";
                /*$tabs = "<li class=><a href='#reg'>Rezervacije</a></li>";
                $divs = "<div id='reg' class='tab'>
                            <h2>Rezervacije</h2>
                            <p>Ovaj tab je za rezervaciju termina, provjeravanje vlastitih rezervacija. Pristup ima svaki registrirani korisnik</p>
                        </div>";*/
            }
            if($_SESSION["uloga"] >= 2){
                $uloga = "moderator";
                /*$tabs .= "<li><a href='#mod'>Moderator</a></li>";
                $divs .= "<div id='mod' class='tab'>
                            <h2>Moderator Postavke</h2>
                            <p>Ovaj tab je za moderatore, za stvaranje termina, za odobravanje rezervacija</p>
                        </div>";*/
            }
            if($_SESSION["uloga"] == 3){
                $uloga = "administrator";
                /*$tabs .= "<li><a href='#admin'>Admin</a></li>";
                $divs .= "<div id='admin' class='tab'>
                            <h2>Admin Postavke</h2>
                            <p>Ovaj tab je za administratore, za stvaranje ronilačkih centara, stvaranje vrsta lokacije, odobravanje ronilačkih lokacija i sl.</p>
                        </div>";*/
            }

            $db = new Baza();
            $db->spojiDB();
            $user= $_SESSION["korisnik"];
            $sql = "select slika_profila from korisnik where kor_ime = '$user'";
            $result = $db->selectDB($sql);
            $slika = mysqli_fetch_array($result)[0];


        }
        $smarty->assign('user', $user);
        $smarty->assign('slika', $slika);
        //$smarty->assign('divs', $divs);
        //$smarty->assign('tabs', $tabs);
        $smarty->assign('uloga', $uloga);

    $smarty->display('profil.tpl');
    $smarty->display('podnozje.tpl');
?>

