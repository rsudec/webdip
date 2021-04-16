<?php

    include_once '../zaglavlje.php';
    if(isset($_SESSION)){
        

        $db = new Baza();
        $db->spojiDB();
        $sql = "Select id from korisnik where kor_ime = '$_SESSION[korisnik]'";
        $result = $db->selectDB($sql);
        $user_id = mysqli_fetch_array($result)[0];
        
        spremiLog($user_id, "Odjava", 1);
        //session_unset();
        //session_destroy();
        Sesija::obrisiSesiju();
    }
    

    header("Location: ../index.php");