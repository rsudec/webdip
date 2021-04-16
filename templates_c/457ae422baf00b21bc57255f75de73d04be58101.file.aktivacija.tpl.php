<?php /* Smarty version Smarty-3.1.21-dev, created on 2019-05-29 22:11:19
         compiled from "C:\xampp\htdocs\PROJEKT\templates\aktivacija.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11424769185ceeb3021f76e8-78777174%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '457ae422baf00b21bc57255f75de73d04be58101' => 
    array (
      0 => 'C:\\xampp\\htdocs\\PROJEKT\\templates\\aktivacija.tpl',
      1 => 1559159388,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11424769185ceeb3021f76e8-78777174',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5ceeb302236708_30993023',
  'variables' => 
  array (
    'poruka' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ceeb302236708_30993023')) {function content_5ceeb302236708_30993023($_smarty_tpl) {?><link href="../css/main.css" rel="stylesheet" type="text/css">
<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../js/registracija.js"><?php echo '</script'; ?>
>
</head>
<body class="registerBody">
    <div class="goBack">
        
        <a class="nav-ul-li-a" href="../index.php"><img src="../assets/backSVG.svg"> Povratak</a></li>
    </div>
        
    <div class="main">
        <div class="screen">
            <div class="title">
                <h3>Aktivacija</h3>
            </div>

            <p><?php echo $_smarty_tpl->tpl_vars['poruka']->value;?>
</p>
        </div>
    </div>
</body>
</html><?php }} ?>
