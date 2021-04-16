<link href="../css/main.css" rel="stylesheet" type="text/css">
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"></script>
  <script src="../js/pretraga.js"></script>
</head>
<body onload="eventHandlerPretraga()">
  <nav class="nav">
    <ul class="nav-ul">
      <li class="nav-ul-li"><a class="nav-ul-li-a" href="../index.php">početna</a></li>
      <li class="nav-ul-li"><a class="nav-ul-li-a" href="../pages/pretraga.php">lokacije</a></li>
      {$role}
      {$logged}  
    </ul>  
  </nav>
  <h1 class="title">Naše lokacije</h1>
  <main class="lokacijaMain">
      
      <div class="filtriranje">
        <h3>Opcije Filtriranja</h3>
        <div class="filterVrsta">
            <p>Biraj vrstu lokacije za koju si zainteresiran</p>
        </div>
        <div class="filterCentar">
            <p>Biraj ronilački centar koji ti je posebno zanimljiv</p>
        </div>
        <div class="btnsFilter">
            <div class="btnFilter">
                <p>Filtriraj</p>
            </div>
            <div class="btnFilter">
                <p>Poništi filter</p>
            </div>
        </div>
      </div>
      <div class="prikazLokacija">
          <h3>Prikaz lokacija</h3>
          
      </div>
      <div class="paginate">
        
      </div>
  </main>