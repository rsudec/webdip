<?php /* Smarty version Smarty-3.1.21-dev, created on 2019-06-01 12:48:53
         compiled from "C:\xampp\htdocs\PROJEKT\templates\lokacija.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19609080245cedb99d9ad100-68478360%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6fbcad14779ee0ca18d7922f428fe67130794ebe' => 
    array (
      0 => 'C:\\xampp\\htdocs\\PROJEKT\\templates\\lokacija.tpl',
      1 => 1559386132,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19609080245cedb99d9ad100-68478360',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5cedb99d9f0184_64231415',
  'variables' => 
  array (
    'role' => 0,
    'logged' => 0,
    'lokacije' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cedb99d9f0184_64231415')) {function content_5cedb99d9f0184_64231415($_smarty_tpl) {?><link href="../css/main.css" rel="stylesheet" type="text/css">
<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/0.71/jquery.csv-0.71.min.js"><?php echo '</script'; ?>
>
 
<?php echo '<script'; ?>
 src="../js/lokacijaPaginate.js"> <?php echo '</script'; ?>
>
</head>
<body>
  <nav class="nav">
    <ul class="nav-ul">
      <li class="nav-ul-li"><a class="nav-ul-li-a" href="../index.php">početna</a></li>
      <li class="nav-ul-li"><a class="nav-ul-li-a" href="pretraga.php">lokacije</a></li>
      <?php echo $_smarty_tpl->tpl_vars['role']->value;?>

      <?php echo $_smarty_tpl->tpl_vars['logged']->value;?>
      
    </ul>
  </nav>
  <div id="div_pagination">
        <input type="hidden" id="txt_rowid" value="0">
        <input type="hidden" id="txt_allcount" value="0">
        <input type="button" class="button" value="Previous" id="but_prev" />
        <input type="button" class="button" value="Next" id="but_next" />
    </div>
  <div class="mainDiv">
      
    
    <?php echo $_smarty_tpl->tpl_vars['lokacije']->value;?>

    
    
  </div><?php }} ?>
