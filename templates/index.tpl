<link href="css/main.css" rel="stylesheet" type="text/css">
</head>
<body>
  <nav class="navIndex">
    <ul class="nav-ul">
      <li class="nav-ul-li"><a class="nav-ul-li-a-ind" href="index.php">početna</a></li>
      <li class="nav-ul-li"><a class="nav-ul-li-a-ind" href="pages/pretraga.php">lokacije</a></li>
      {$role}
      {$logged}    
    </ul>
  </nav>
  <section class="prviDio">
    <div class="welcome">
      <h1 class="naslov">Dobrodošli
        <p class="opis">u svijet ronjenja</p>
      </h1>
      <p class="navlačenje">Profesionalac ste? <br> Ponekad zaronite? <br> Želite iskusiti ronjenje?</p>
      <a href="#drugiDio">    
        <div class="btnContainer">
          <p>ISTRAŽI</p>   
        </div>
      </a>
    </div>
  </section>
  <section id="drugiDio">
    <div class="homePartners">      
      <h2>Naši partneri</h2>      
      <p>Pogledajte s kim surađujemo</p>
      <img src="assets/partnershipSVG.svg">
      <a href="pages/centar.php">
        <div class="btn">
            <p>RONILAČKI CENTRI</p>   
        </div>
      </a>
    </div>    
    <div class="homeLokacije">
      <h2>Vaš odabir</h2>
      <p>Lokacije na kojima možete roniti</p>
      <img src="assets/locationSVG.svg">
      <a href="pages/lokacija.php">
        <div class="btn">
            <p>RONILAČKE LOKACIJE</p>   
        </div>
      </a>
    </div>    
    <div class="homeIskustva">
      <h2>Iskustva ostalih</h2>
      <p>Što kažu ostali?</p>
      <div class="komentar">
        <img src="assets/avatar1SVG.svg">
        <p class="comm">Ludo i nezaboravno iskustvo. Preporuke svima!</p>
        <p class="sign">-Marko P.</p>
      </div>
      <div class="komentar">
        <img src="assets/avatar2SVG.svg">
        <p class="comm">Ludo i nezaboravno iskustvo. Preporuke svima!</p>
        <p class="sign">-Marko P.</p>
      </div>
      <div class="komentar">
        <img src="assets/avatar3SVG.svg">
        <p class="comm">Ludo i nezaboravno iskustvo. Preporuke svima!</p>
        <p class="sign">-Marko P.</p>
      </div>
        <div class="komentar">
          <img src="assets/avatar4SVG.svg">
          <p class="comm">Ludo i nezaboravno iskustvo. Preporuke svima!</p>
          <p class="sign">-Marko P.</p>
        </div>
    </div>
    <div class="homeRegister">
      <h2>Sviđa ti se što vidiš?</h2>
      <p>Besplatno se registriraj kod nas</p>
      <img src="assets/registerSVG.svg">
      <a href="form/registracija.php">
        <div class="btn">
        <p>REGISTRACIJA</p>
      </div>
    </a>
    </div>
    <div class="prazno"></div>
  </section>