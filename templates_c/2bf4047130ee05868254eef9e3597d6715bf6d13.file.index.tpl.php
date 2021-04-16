<?php /* Smarty version Smarty-3.1.21-dev, created on 2019-06-02 02:10:43
         compiled from "C:\xampp\htdocs\PROJEKT\templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12848261015cedb656423438-61393270%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2bf4047130ee05868254eef9e3597d6715bf6d13' => 
    array (
      0 => 'C:\\xampp\\htdocs\\PROJEKT\\templates\\index.tpl',
      1 => 1559433343,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12848261015cedb656423438-61393270',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5cedb656437667_79445860',
  'variables' => 
  array (
    'role' => 0,
    'logged' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cedb656437667_79445860')) {function content_5cedb656437667_79445860($_smarty_tpl) {?><link href="css/main.css" rel="stylesheet" type="text/css">
</head>
<body>
  <nav class="navIndex">
    <ul class="nav-ul">
      <li class="nav-ul-li"><a class="nav-ul-li-a-ind" href="index.php">početna</a></li>
      <li class="nav-ul-li"><a class="nav-ul-li-a-ind" href="pages/pretraga.php">lokacije</a></li>
      <?php echo $_smarty_tpl->tpl_vars['role']->value;?>

      <?php echo $_smarty_tpl->tpl_vars['logged']->value;?>
    
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
  </section><?php }} ?>
