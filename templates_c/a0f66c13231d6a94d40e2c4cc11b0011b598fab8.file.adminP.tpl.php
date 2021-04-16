<?php /* Smarty version Smarty-3.1.21-dev, created on 2019-06-04 11:23:29
         compiled from "/var/www/webdip.barka.foi.hr/2018/zadaca_01/rsudec/projekt/templates/adminP.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7502040235cf63891197b35-16023446%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a0f66c13231d6a94d40e2c4cc11b0011b598fab8' => 
    array (
      0 => '/var/www/webdip.barka.foi.hr/2018/zadaca_01/rsudec/projekt/templates/adminP.tpl',
      1 => 1559640031,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7502040235cf63891197b35-16023446',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'role' => 0,
    'logged' => 0,
    'user' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5cf638911a50b5_24999361',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cf638911a50b5_24999361')) {function content_5cf638911a50b5_24999361($_smarty_tpl) {?><link href="../css/main.css" rel="stylesheet" type="text/css">
<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/0.71/jquery.csv-0.71.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../js/adminP.js"> <?php echo '</script'; ?>
>
</head>
<body id="" onload="adminPanel()">
  <nav class="nav">
    <ul class="nav-ul">
      <li class="nav-ul-li"><a class="nav-ul-li-a" href="../index.php">početna</a></li>
      <li class="nav-ul-li"><a class="nav-ul-li-a" href="../pages/pretraga.php">lokacije</a></li>
      <?php echo $_smarty_tpl->tpl_vars['role']->value;?>

      <?php echo $_smarty_tpl->tpl_vars['logged']->value;?>
  
    </ul>  
  </nav>
  <div class="head">
    <h1 class="title">Pozdrav, <?php echo $_smarty_tpl->tpl_vars['user']->value;?>
</h1>
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
  <?php }} ?>
