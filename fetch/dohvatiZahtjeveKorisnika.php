<?php
    require_once "../libs/baza.class.php";
    require_once "../libs/sesija.class.php";
    $user = Sesija::dajKorisnika();

    $user = $user["korisnik"];
    $db = new Baza();
    $db->spojiDB();
    if(isset($_GET['rowid'])){
        
        $rowid = $_GET['rowid'];
        $rowperpage = $_GET['rowperpage'];
        $sql = "select count(*) from zahtjev_rezervacija left join korisnik as k on k.ID = ID_korisnik where kor_ime='$user' ";
        $result = $db->selectDB($sql);      
        $ukupnoZapisa = mysqli_fetch_array($result)[0];
        $search = $_GET["text"];
        $sql = "SELECT zr.Id, zr.Status, zr.ID_termin, t.Početak,
                    t.Kraj, t.Zavrseno, t.Broj_slobodnih_mjesta,
                    rn.Naziv , zr.max_dubina, zr.datum_odobrenja_odbijanja
                    FROM zahtjev_rezervacija as zr 
                    left join korisnik as k on k.id=zr.id_korisnik 
                    left join termin_ronjenja as t on t.id = zr.id_termin 
                    left join lokacija_za_ronjenje as rn on rn.ID = t.ID_lokacija
                    where
                        k.kor_ime = '$user'
                        and
                         (zr.Id LIKE '%$search%'
                        OR zr.Status LIKE '%$search%'
                        or zr.ID_termin LIKE '%$search%'
                        or t.Početak LIKE '%$search%'
                        or t.Kraj LIKE '%$search%'
                        or t.Zavrseno LIKE '%$search%'
                        or t.Broj_slobodnih_mjesta LIKE '%$search%'
                        or rn.Naziv LIKE '%$search%'
                        or zr.max_dubina  LIKE '%$search%'
                        or zr.datum_odobrenja_odbijanja LIKE '%$search%') 
                    limit $rowid, $rowperpage";

        $result = $db->selectDB($sql);
        $odgovor = array();
        $redak["ukupno"] = $ukupnoZapisa;
        $odgovor[] = $redak;
        while($row = mysqli_fetch_row($result)){
            $redak["id_zahtjev"] = $row[0];
            $redak["status"] = $row[1];
            $redak["id_termin"] = $row[2];
            $redak["početak"] = $row[3];
            $redak["kraj"] = $row[4];
            $redak["zavrseno"] = $row[5];
            $redak["broj_slobodnih_mjesta"] = $row[6];
            $redak["lokacija"] = $row[7];
            $redak["max_dubina"]=$row[8];
            $redak["datum"]=$row[9];
            $redak["delete"] = "";
            
            $vrijemeTermin = new DateTime("$redak[početak]");
            if($vrijemeTermin > Vrijeme() ){
                $redak["delete"] = "<img height=25px src='../assets/icon_remove.svg' alt='remove' onclick='removeZahtjev($redak[id_zahtjev], $redak[id_termin])'>";
            }

            $odgovor[] = $redak;            
        }
        $db->zatvoriDB();
        header("Content-Type: application/json");
        echo json_encode($odgovor);

    }
    function dohvatiPomakVremena(){
            
        $jsonVrijeme = file_get_contents("http://barka.foi.hr/WebDiP/pomak_vremena/pomak.php?format=json");
        $array = json_decode($jsonVrijeme, true);
        return $array['WebDiP']['vrijeme']['pomak']['brojSati'];
    }
    function Vrijeme(){
        $vrijemeServer = new DateTime();
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
?>
