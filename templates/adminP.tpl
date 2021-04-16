<link href="../css/main.css" rel="stylesheet" type="text/css">
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/0.71/jquery.csv-0.71.min.js"></script>
<script src="../js/adminP.js"> </script>
</head>
<body id="" onload="adminPanel()">
  <nav class="nav">
    <ul class="nav-ul">
      <li class="nav-ul-li"><a class="nav-ul-li-a" href="../index.php">početna</a></li>
      <li class="nav-ul-li"><a class="nav-ul-li-a" href="../pages/pretraga.php">lokacije</a></li>
      {$role}
      {$logged}  
    </ul>  
  </nav>
  <div class="head">
    <h1 class="title">Pozdrav, {$user}</h1>
  </div>
  <div id="panelBody">
    <div class="dio">
        <h3>Postavi pomak vremena</h3>
        <div>
            <!--<form action="http://barka.foi.hr/WebDiP/pomak_vremena/vrijeme.php" method="POST">
            <p>Unesi pomak</p>
            <input type="text" placeholder="pomak" name="pomak" id="pomak">
            <input type="submit" value="Dodaj">
            </form> -->
            <p>Unesi pomak</p>
            <input type="text" placeholder="pomak" name="pomak" id="pomak">
            <div class="button" id="submitPomak">
                <p>Postavi pomak</p>
            </div>
            <p id="greskaPomak">Unesi pomak!</p>
            <p id="uspjehPomak">Pomak postavljen</p>
        </div>
    </div>
    <div class="dio">
        <h3>Blokiraj / Otključaj korisnički račun</h3>
        <div>
            <select id="selectBlokiraniKorisnik">
                <option id="">Odaberi blokiranog korisnika</option>
            </select>
            <div class="button" id="otključajKorisnika">
                <p>Otključaj</p>
            </div>
            <p id="uspjehUnBanKorisnik"> Korisnik otključan</p> 
        </div>
        <div>
            <select id="selectOtključanKorisnik">
                <option id="">Odaberi otključanog korisnika</option>
            </select>
            <div class="button" id="blokirajKorisnika">
                <p>Blokiraj</p>
            </div>
            <p id="uspjehBanKorisnik"> Korisnik blokiran</p> 
        </div>
        
    </div>
    <div class="dio">
        <h3>Konfiguracija sustava</h3>
        <p>Trajanje linka za email aktivaciju</p>
        <input type="text" value="" id="cfgEmailAkt">
        <p>Trajanje cookie-a za prijavu</p>
        <input type="text" value="" id="cfgCookie">
        <p>Maks broj neuspjelih prijava</p>
        <input type="text" value="" id="cfgMaxPrijava">
        <p>Broj zapisa po stranici -> Straničenje</p>
        <input type="text" value="" id="cfgNumStranice">
        <div class="button" id="postaviCFG">
                <p>Postavi config</p>
            </div>
    </div>
    <div class="dio">
        <h3>Dnevnik</h3>
        <table class='table'>
          <thead>
            <td>ID Log</td>
            <td>Vrijednost</td>
            <td>Vrijeme</td>
            <td>Korisnik</td>
            <td>Tip</td>
          </thead>
          <tbody id="tableBodyLog">

          </tbody>
        </table>
        <div id="div_paginationAdm">
          <input type="hidden" id="txt_rowidAdm" value="0">
          <input type="hidden" id="txt_allcountAdm" value="0">
          <input type="button" class="button" value="Previous" id="but_prevAdm" />
          <input type="button" class="button" value="Next" id="but_nextAdm" />
          <input type="text" class="inpText" placeholder="Pretraživanje" value="" id="searchLogAdm">
        </div>
    </div>  

  </div>
  