<?php /* Smarty version Smarty-3.1.21-dev, created on 2019-06-04 11:46:36
         compiled from "/var/www/webdip.barka.foi.hr/2018/zadaca_01/rsudec/projekt/templates/aktivacija.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13961430125cf63dfcc58393-97747827%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '21a75e3346be4239407840597f26562669b2e2a6' => 
    array (
      0 => '/var/www/webdip.barka.foi.hr/2018/zadaca_01/rsudec/projekt/templates/aktivacija.tpl',
      1 => 1559640031,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13961430125cf63dfcc58393-97747827',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'poruka' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5cf63dfcc63b04_76726306',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cf63dfcc63b04_76726306')) {function content_5cf63dfcc63b04_76726306($_smarty_tpl) {?><link href="../css/main.css" rel="stylesheet" type="text/css">
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
