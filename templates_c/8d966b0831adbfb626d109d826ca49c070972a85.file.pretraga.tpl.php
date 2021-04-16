<?php /* Smarty version Smarty-3.1.21-dev, created on 2019-05-30 23:27:20
         compiled from "C:\xampp\htdocs\PROJEKT\templates\pretraga.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8283783145cedb82ed37b31-26318124%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8d966b0831adbfb626d109d826ca49c070972a85' => 
    array (
      0 => 'C:\\xampp\\htdocs\\PROJEKT\\templates\\pretraga.tpl',
      1 => 1559239247,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8283783145cedb82ed37b31-26318124',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5cedb82ed75327_45202184',
  'variables' => 
  array (
    'role' => 0,
    'logged' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cedb82ed75327_45202184')) {function content_5cedb82ed75327_45202184($_smarty_tpl) {?><link href="../css/main.css" rel="stylesheet" type="text/css">
  <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="../js/pretraga.js"><?php echo '</script'; ?>
>
</head>
<body onload="eventHandlerPretraga()">
  <nav class="nav">
    <ul class="nav-ul">
      <li class="nav-ul-li"><a class="nav-ul-li-a" href="../index.php">početna</a></li>
      <li class="nav-ul-li"><a class="nav-ul-li-a" href="../pages/pretraga.php">lokacije</a></li>
      <?php echo $_smarty_tpl->tpl_vars['role']->value;?>

      <?php echo $_smarty_tpl->tpl_vars['logged']->value;?>
  
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
  </main><?php }} ?>
