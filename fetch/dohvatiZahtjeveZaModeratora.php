<?php
    require_once "../libs/baza.class.php";
    require_once "../libs/sesija.class.php";
    $user = Sesija::dajKorisnika();


    $db = new Baza();
    $db->spojiDB();
    if(isset($_GET['rowid'])){
        $rowid = $_GET['rowid'];
        $rowperpage = $_GET['rowperpage'];
        $sql = "select count(id) from zahtjev_rezervacija where status = 'Predano'"; //"left join korisnik  where kor_ime = '$_SESSION[korisnik]' ";
        $result = $db->selectDB($sql);      
        $ukupnoZapisa = mysqli_fetch_array($result)[0];
        $search = $_GET["text"];
        $sql = "SELECT zr.Id, k.kor_ime,  zr.ID_termin,
                    t.Zavrseno, t.Broj_slobodnih_mjesta,
                    rn.Naziv , zr.max_dubina, rn.dubina,
                    zr.datum_odobrenja_odbijanja
                    FROM zahtjev_rezervacija as zr 
                    left join korisnik as k on k.id=zr.id_korisnik 
                    left join termin_ronjenja as t on t.id = zr.id_termin 
                    left join lokacija_za_ronjenje as rn on rn.ID = t.ID_lokacija 
                    where zr.status = 'Predano'
                        and
                            (zr.Id LIKE '%$search%'
                            OR k.kor_ime LIKE '%$search%'
                            OR zr.ID_termin LIKE '%$search%'
                            OR t.Zavrseno LIKE '%$search%'
                            OR t.Broj_slobodnih_mjesta LIKE '%$search%'
                            OR rn.Naziv LIKE '%$search%'
                            OR zr.max_dubina LIKE '%$search%'
                            OR rn.dubina LIKE '%$search%'
                            OR zr.datum_odobrenja_odbijanja LIKE '%$search%')
                    limit $rowid, $rowperpage";
                    //where k.kor_ime = '$_SESSION[korisnik]
        $result = $db->selectDB($sql);
        $odgovor = array();
        $redak["ukupno"] = $ukupnoZapisa;
        $odgovor[] = $redak;
        while($row = mysqli_fetch_row($result)){
            $redak["id_zahtjev"] = $row[0];
            $redak["user"] = $row[1];
            $redak["id_termin"] = $row[2];
            $redak["zavrseno"] = $row[3];
            $redak["broj_slobodnih_mjesta"] = $row[4];
            $redak["lokacija"] = $row[5];
            $redak["max_dubina"]=$row[6];
            $redak["dubina"] = $row[7];
            //$redak["datum"] =$row[8];
            $redak["odobri"] = "";
            $redak["odbij"] = "";
            $redak["poseban"] = "";
            $brojSlobodnih = $redak["broj_slobodnih_mjesta"];
            if($brojSlobodnih > 0 && $row[3] == 0){
                $redak["odobri"] = "<img height=25px src='../assets/icon_odobri.svg' alt='odobri' onclick='odobriZahtjev($redak[id_zahtjev])'>";
            }
            $redak["odbij"]="<img height=25px src='../assets/icon_remove.svg' alt='odbij' onclick='odbijZahtjev($redak[id_zahtjev])'>";
            if($redak["max_dubina"]<$redak["dubina"]){
                $redak["poseban"] = "<span class='poseban'></span>";
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