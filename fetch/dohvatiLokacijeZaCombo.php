<?php
    require("../libs/baza.class.php");
    require("../libs/sesija.class.php");
    $db = new Baza();
    $db->spojiDB();
    $user = Sesija::dajKorisnika()["korisnik"];

    $sql = "Select id from korisnik where kor_ime = '$user' ";
    $userID = mysqli_fetch_array($db->selectDB($sql))[0];

    if(isset($_GET['uploadslike'])){
        $sql = "SELECT 
                    lr.id, lr.Naziv 
                    FROM `zahtjev_rezervacija` as zr 
                        left join termin_ronjenja as tr 
                            on ID_termin = tr.id 
                        left join lokacija_za_ronjenje as lr 
                            on tr.ID_lokacija = lr.ID 
                    where 
                        tr.zavrseno = 1 
                        AND id_korisnik = 32 
                        AND zr.status = 'Odobren'";
        $result = $db->selectDB($sql);
        $odgovor = array();

        while($row = mysqli_fetch_array($result)){
            $redak["id"] = $row[0];
            $redak["naziv"] = $row[1];
            $odgovor[] = $redak;

        }
        $db->zatvoriDB();
        header("Content-Type: application/json");
        echo json_encode($odgovor);
    }
    if(isset($_GET["novitermin"])){
        $sql = "SELECT lr.id, lr.naziv
                    FROM lokacija_za_ronjenje as lr
                        left join ronilacki_centar as rc
                            on lr.id_centar = rc.id
                        left join je_moderator as m
                            on m.ID_centar =rc.id
                        where m.id_korisnik = $userID 
                            AND lr.odobreno = 1";
        $result = $db->selectDB($sql);
        $odgovor = array();

        while($row = mysqli_fetch_array($result)){
            $redak["id"] = $row[0];
            $redak["naziv"] = $row[1];
            $odgovor[] = $redak;

        }
        $db->zatvoriDB();
        header("Content-Type: application/json");
        echo json_encode($odgovor);               
    }   
