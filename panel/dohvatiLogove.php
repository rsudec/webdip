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
        $sql = "select count(*) from log";
        $result = $db->selectDB($sql);      
        $ukupnoZapisa = mysqli_fetch_array($result)[0];
        $search = $_GET["text"];
        $sql = "select 
                        l.id, l.vrijednost, l.vrijeme, k.kor_ime, t.Opis_tipa 
                    from 
                        log as l 
                            left join 
                                korisnik as k 
                                    on k.id = l.ID_korisnik 
                            left join 
                                tip_log as t
                                    on t.ID=l.ID_tip
                    where
                        l.Id LIKE '%$search%'
                        OR l.vrijednost LIKE '%$search%'
                        or l.vrijeme LIKE '%$search%'
                        or k.kor_ime LIKE '%$search%'
                        or t.Opis_tipa  LIKE '%$search%'
                    limit $rowid, $rowperpage";

        $result = $db->selectDB($sql);
        $odgovor = array();
        $redak["ukupno"] = $ukupnoZapisa;
        $odgovor[] = $redak;
        while($row = mysqli_fetch_row($result)){
            $redak["id"] = $row[0];
            $redak["vrijednost"] = $row[1];
            $redak["vrijeme"] = $row[2];
            $redak["korisnik"] = $row[3];
            $redak["tip"] = $row[4];
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
