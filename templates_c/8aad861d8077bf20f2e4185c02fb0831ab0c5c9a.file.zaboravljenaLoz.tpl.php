<?php /* Smarty version Smarty-3.1.21-dev, created on 2019-06-04 11:23:39
         compiled from "/var/www/webdip.barka.foi.hr/2018/zadaca_01/rsudec/projekt/templates/zaboravljenaLoz.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6893506775cf6389b25c069-79743452%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8aad861d8077bf20f2e4185c02fb0831ab0c5c9a' => 
    array (
      0 => '/var/www/webdip.barka.foi.hr/2018/zadaca_01/rsudec/projekt/templates/zaboravljenaLoz.tpl',
      1 => 1559640031,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6893506775cf6389b25c069-79743452',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'porukaForgot' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5cf6389b265fd4_50470297',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cf6389b265fd4_50470297')) {function content_5cf6389b265fd4_50470297($_smarty_tpl) {?><link href="../css/main.css" rel="stylesheet" type="text/css">
<?php echo '<script'; ?>
 src="../js/registracija.js"><?php echo '</script'; ?>
>
</head>
<body class="loginBody" onload="eventHandlerForgot()">
    <div class="goBack">
        <a class="nav-ul-li-a" href="../index.php"><img src="../assets/backSVG.svg"> Povratak</a></li>
    </div>
        
    <div class="main">
        <div class="screen">
            <div class="title">
                <h3>Zaboravili ste lozinku?</h3>
            </div>

            <form class="form" id="form" method="POST" action="../form/zaborav.php">
                <div class="group">
                    <input type="text" class="field"  placeholder="email" name="email" id="email" value="">
                    <label class="login-field-icon fui-user" for="email"></label>
                </div>
                <p class="registrationErr">Unesite email</p>
                <input type="submit" name="submit" value="Zaboravio/la sam" id="submit">
                <p class="registrationErr"><?php echo $_smarty_tpl->tpl_vars['porukaForgot']->value;?>
</p>
            </form>
        </div>
    </div>
</body>
</html><?php }} ?>
