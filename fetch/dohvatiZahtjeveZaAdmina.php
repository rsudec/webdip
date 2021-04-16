<?php
    require_once "../libs/baza.class.php";
    require_once "../libs/sesija.class.php";
    $user = Sesija::dajKorisnika();


    $db = new Baza();
    $db->spojiDB();
    if(isset($_GET['rowid'])){
        $rowid = $_GET['rowid'];
        $rowperpage = $_GET['rowperpage'];
        $sql = "select count(id) from lokacija_za_ronjenje where odobreno = 0"; //"left join korisnik  where kor_ime = '$_SESSION[korisnik]' ";
        $result = $db->selectDB($sql);      
        $ukupnoZapisa = mysqli_fetch_array($result)[0];
        $search = $_GET["text"];
        $sql = "SELECT 
                    l.id, l.naziv, l.dubina, l.broj_mjesta, l.opis, v.vrsta_lokacije, r.naziv, g.naziv
                FROM lokacija_za_ronjenje as l 
                    left join vrsta_ronilacke_lokacije as v on v.id=l.id_vrsta_lokacije 
                    left join ronilacki_centar as r on r.id = l.id_centar 
                    left join grad as g on g.ID = l.ID_grad 
                    where odobreno = 0
                        and
                            (l.Id LIKE '%$search%'
                            OR l.naziv LIKE '%$search%'
                            OR l.dubina LIKE '%$search%'
                            OR l.broj_mjesta LIKE '%$search%'
                            OR l.opis LIKE '%$search%'
                            OR v.vrsta_lokacije LIKE '%$search%'
                            OR r.naziv LIKE '%$search%'
                            OR g.naziv LIKE '%$search%')
                    limit $rowid, $rowperpage";
                    //where k.kor_ime = '$_SESSION[korisnik]
        $result = $db->selectDB($sql);
        $odgovor = array();
        $redak["ukupno"] = $ukupnoZapisa;
        $odgovor[] = $redak;
        while($row = mysqli_fetch_row($result)){
            $redak["id"] = $row[0];
            $redak["naziv"] = $row[1];
            $redak["dubina"] = $row[2];
            $redak["brojMjesta"] = $row[3];
            $redak["opis"] = $row[4];
            $redak["vrstaLok"] = $row[5];
            $redak["centar"]=$row[6];
            $redak["grad"] = $row[7];
            $redak["odobri"] = "<img height=25px src='../assets/icon_odobri.svg' alt='odobri' onclick='prihvatiLokaciju($redak[id])'>";
            $redak["odbij"]="<img height=25px src='../assets/icon_remove.svg' alt='odbij' onclick='odbijLokaciju($redak[id])'>";
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