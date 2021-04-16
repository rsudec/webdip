<link href="../css/main.css" rel="stylesheet" type="text/css">
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/0.71/jquery.csv-0.71.min.js"></script>
<script src="../js/profil.js"></script>
</head>
<body id="profil" onload="{$uloga}()">
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
    <img src="../assets/slike/{$slika}" alt="">
  </div>
  <div class ="tabs">
    <ul class="tabs-list">
      <li class='active'><a href='#user'>Korisnik</a></li>
      <li><a href='#reg'>Rezervacije</a></li>
      <li id='liMod' class='hidden'><a href='#mod'>Moderator</a></li>
      <li id='liAdm' class='hidden'><a href='#admin'>Admin</a></li>
    </ul>
  
    <div id="user" class="tab active">
      <h2>Uredi profil</h2>
      <p>Ovaj tab je za uređivanje korisničkog profila</p>
    </div>
    <div id='reg' class='tab'>
      <div class="dio">
        <h3>Moje rezervacije</h3>
        <table class='table'>
          <thead>
            <td>Zahtjev Br.</td>
            <td>Status</td>
            <td>Termin Br.</td>
            <td>Početak</td>
            <td>Kraj</td>
            <td>Završen</td>
            <td>Broj slobodnih mjesta</td>
            <td>Max dubina</td>
            <td>Lokacija</td>
            <td>Datum odobrenja/odbijanja</td>
          </thead>
          <tbody id="tableBodyRez">

          </tbody>
        </table>
        <div id="div_pagination">
          <input type="hidden" id="txt_rowid" value="0">
          <input type="hidden" id="txt_allcount" value="0">
          <input type="button" class="button" value="Previous" id="but_prev" />
          <input type="button" class="button" value="Next" id="but_next" />
          <br>
          <input type="text" class="inpText" value="" placeholder="Pretraživanje" id="searchZahtjevReg">
        </div>
      </div>
      <div class="dio">
        <h3> Nova rezervacija termina </h3>
        <div id="zahtjevOdaberiCentar">
            <p>Odaberi centar</p>
            <select id="regCboxCentar">
              <option value="">Odaberi..</option>
            </select>
        </div>
        <div id="zahtjevOdaberiLokaciju">
            <p>Odaberi lokaciju</p>
            <select id="regCboxLokacija">
              <option value="">Odaberi centar za prikaz lokacija</option>
            </select>
        </div>
        <div id="zahtjevOdaberiTermin">
            <p>Odaberi termin</p>
            <select id="regCboxTermin">
              <option value="">Odaberi lokaciju za prikaz termina</option>
            </select>
        </div>
        <div id="zahtjevDubina">
            <p>Koliko duboko roniš? (u metrima)</p>
            <input type="text" value="" placeholder="Dubina ronjenja" id="maxDubinaKorisnika">
        </div>
        <br>
        <div class="button" id="zahtjevRezervacija">
                <p>Rezerviraj</p>
        </div>
        <div>
          <p id="greskaRezerviraj">Sva polja su obavezna</p>
          <p id="greskaRezerviraj1">Već ste rezervirali taj termin</p>
        </div>
      </div>
      <div class="dio">
        <h3>Podijeli slike s našom zajednicom</h3>
        <div>
          
            <label>Lokacija za koju želiš objaviti sliku:</label>
            <br/>
            <form id="formUploadSlike" action="../other/uploadSlike.php" enctype="multipart/form-data">
            <select id="regUploadLokacija">
              <option value="">Odaberi lokaciju na kojoj si ronio</option>
            </select>
            <br>
            <input type="file" name="file" id="file">
            <input type="text" id="opisSlike">
            <br>
            <button type="submit" class="button" id="submit">Upload</button>
          </form>          
          <p id="prijenosMessage"></p>
        </div>
      </div>
    </div>
    <div id='mod' class='tab hidden'>
      <div class="dio">
        <h3>Zahtjevi korisnika</h3>
        <table class='table'>
          <thead>
            <td>Zahtjev Br.</td>
            <td>Korisnik</td>
            <td>Termin Br.</td>
            <td>Zavrseno</td>
            <td>Broj slobodnih mjesta</td>
            <td>Lokacija</td>
            <td>Max dubina korisnika</td>
            <td>Dubina lokacije</td>
          </thead>
          <tbody id="tableBodyMod">

          </tbody>
        </table>
        <div id="div_paginationMod">
          <input type="hidden" id="txt_rowidMod" value="0">
          <input type="hidden" id="txt_allcountMod" value="0">
          <input type="button" class="button" value="Previous" id="but_prevMod" />
          <input type="button" class="button" value="Next" id="but_nextMod" />
          <input type="text" class="inpText" placeholder="Pretraživanje" value="" id="searchZahtjevMod">
        </div>
      </div>
      <div class="dio">
        <h3>Kreiraj novi termin</h3>
        <div id="modOdabirLokacijeZaTermin">
          <p>Odaberi za koju lokaciju stvaraš termin</p>
          <select id="lokacijeZaNoviTermin">
            <option value="">Odaberi lokaciju</option>
          </select>
        </div>
        <div>
          <div class="datum">
            <label>Početak:</label>
            <input type="date" id="datumPoc">
            <input type="time" id="timePoc">
          </div>
          <div class="datum">
            <label>Kraj</label>
            <input type="date" id="datumKraj">
            <input type="time" id="timeKraj">
          </div>
          <p id="greskaKreiranjeTermina">Odaberite lokaciju i točno vrijeme termina</p>
          <p id="uspjehKreiranjeTermina">Kreirali ste termin!</p>
          
          <button type="submit" class="button" id="kreirajTermin">Kreiraj</button>
        </div>
      </div>
      <div class="dio">
        <h3>Postavi termin u stanje završeno</h3>
        <p>Odaberi termin</p>
        <div>
          <select id="postaviNaZavrsenoCombo">
              <option value="">Odaberi termin</option>
          </select>
          <button type="submit" class="button" id="PostaviNaZavrseno">Postavi na zavrseno</button>
        </div>
      </div> 
      <div class="dio">
        <h3>Dodaj novu lokaciju</h3>
        <div id="modOdabirCentraZaNovuLokaciju">
          <p>Odaberi centar</p>
          <select id="centarZaNovuLokaciju">
            <option value=""> Odaberi centar</option>
          </select>
          <p>Odaberi vrstu lokacija</p>
          <select id="vrstaZaNovuLokaciju">
            <option value="">Odaberi vrstu </option>
          </select>
          <p>Odaberi grad u kojem se nalazi</p>
          <select id="gradZaNovuLokaciju">
            <option value="">Odaberi grad </option>
          </select>
          <p>Naziv lokacije</p>
          <input type="text" value="" placeholder="Naziv" id="textNovaLokacija">
          <p>Vrijeme prijevoza</p>
          <input type="time" id="timeNovaLokacija">
          <p>Dubina</p>
          <input type="text" value="" placeholder="Dubina" id="dubinaNovaLokacija">
          <p>Broj mjesta po terminu</p>
          <input type="text" value="" placeholder="Broj mjesta" id="mjestaNovaLokacija">
          <p>Opis</p>
          <input type="textarea" multiline value="" placeholder="Opis lokacije" id="opisNovaLokacija">
          <button type="submit" class="button" id="dodajNovuLokaciju">Dodaj</button>
          <p id="greskaDodajLokaciju">Unesite vrijednosti u sva polja!</p>
          <p id="uspjehDodajLokaciju">Uspješno ste dodali lokaciju, sada čekate admina da potvrdi</p>
        </div>
      </div> 
    </div>
    <div id='admin' class='tab hidden'>
    <div class="dio">
      <h3>Kreiraj ronilački centar</h3>
      <div>
        <p>Naziv centra</p>
        <input type="text" placeholder="Naziv" id="textNoviCentar">
        <p>OIB</p>
        <input type="text" placeholder="oib" id="oibNoviCentar">
        <p>Telefon</p>
        <input type="text" placeholder="telefon" id="telNoviCentar">
        <p>Datum otvaranja</p>
        <input type="date" id="dateNoviCentar"> 
        <p>Adresa</p>
        <input type="text" id="addrNoviCentar">
        <p>Grad</p>
        <select id="gradNoviCentar">
          <option value=""> Odaberi grad</p>
        </select>
        <button type="submit" class="button" id="dodajNoviCentar">Dodaj centar</button>
        <p id="greskaDodajCentar">Unesite sve podatke za unos</p>
        <p id="uspjehDodajCentar">Uspješno dodan centar</p>
      </div>
    </div>
    <div class="dio">
      <h3>Dodijeli moderatora nekom centru</h3>
      <div>
        <p>Odaberi centar</p>
        <select id="dodijeliModaCentar">
          <option id="">Odaberi centar</option>
        </select>
        <p>Odaberi moderatora</p>
        <select id="dodijeliModaMod">
          <option id="">Odaberi moderatora</option>
        </select>
        <button type="submit" class="button" id="dodijeliModeratora">Dodijeli</button>
        <p id="greskaDodjelaModa">Odaberite centar i korisnika</p>
        <p id="uspjehDodjelaModa">Uspješno dodijeljen mod</p>
      </div>
    </div>
    <div class="dio">
      <h3>Kreiraj vrstu lokacije</h3>
      <div>
        <p>Vrsta lokacije</p>
        <input type="text" placeholder="Vrsta" id="textNovaVrsta">
        <p>Opis lokacije</p>
        <input type="text" placeholder="Opis" id="opisNovaVrsta">
        <button type="submit" class="button" id="dodajVrstaLokacije">Dodaj vrstu</button>
        <p id="greskaDodajVrstu">Unesite vrstu i opis obavezno</p>
        <p id="uspjehDodajVrstu">Uspješno ste dodali vrstu lokacije</p>
      </div>
    </div>
    <div class="dio">
      <h3>Odobri/odbij nove lokacije</h3>
      <table class='table'>
          <thead>
            <td>ID Lokacije</td>
            <td>Naziv</td>
            <td>Dubina</td>
            <td>Broj Mjesta</td>
            <td>Opis</td>
            <td>Vrsta</td>
            <td>Centar</td>
            <td>Grad</td>
          </thead>
          <tbody id="tableAdmLok">

          </tbody>
        </table>
        <div id="div_paginationAdmLok">
          <input type="hidden" id="txt_rowidAdmLok" value="0">
          <input type="hidden" id="txt_allcountAdmLok" value="0">
          <input type="button" class="button" value="Previous" id="but_prevAdmLok" />
          <input type="button" class="button" value="Next" id="but_nextAdmLok" />
          <input type="text" class="inpText" placeholder="Pretraživanje" value="" id="searchAdmLok">
        </div>
    </div>
  </div>
  