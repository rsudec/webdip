<?php /* Smarty version Smarty-3.1.21-dev, created on 2019-05-30 13:50:17
         compiled from "C:\xampp\htdocs\PROJEKT\templates\prijava.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14186084125cedb836384659-25652102%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3c56ee3533e0e741aa56ad30167971f8632b54be' => 
    array (
      0 => 'C:\\xampp\\htdocs\\PROJEKT\\templates\\prijava.tpl',
      1 => 1559178940,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14186084125cedb836384659-25652102',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5cedb8363f6364_12384619',
  'variables' => 
  array (
    'cookieUser' => 0,
    'porukaPrijava' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cedb8363f6364_12384619')) {function content_5cedb8363f6364_12384619($_smarty_tpl) {?><link href="../css/main.css" rel="stylesheet" type="text/css">
<?php echo '<script'; ?>
 src="../js/registracija.js"><?php echo '</script'; ?>
>
</head>
<body class="loginBody" onload="eventHandlerLogin()">
    <div class="goBack">
        
        <a class="nav-ul-li-a" href="../index.php"><img src="../assets/backSVG.svg"> Povratak</a></li>
    </div>
        
    <div class="main">
        <div class="screen">
            <div class="title">
                <h3>Prijava</h3>
            </div>

            <form class="form" id="form" method="POST" action="../form/prijava.php">
                <div class="group">
                    <input type="text" class="field"  placeholder="korisničko ime" name="korime" id="korime" value="<?php echo $_smarty_tpl->tpl_vars['cookieUser']->value;?>
">
                    <label class="login-field-icon fui-user" for="korime"></label>
                </div>
                <div class="group">
                    <input type="password" class="field" value="" placeholder="lozinka" name="lozinka" id="lozinka">
                    <label class="login-field-icon fui-lock" for="lozinka"></label>
                </div>
                <p class="registrationErr">Unesite podatke u sva polja!</p>
                <input type="submit" name="submit" value="Prijava" id="submit">
                <p class="registrationErr"><?php echo $_smarty_tpl->tpl_vars['porukaPrijava']->value;?>
</p>
                <a class="login-link" href="../form/zaborav.php">Zaboravili ste lozinku?</a>

            </form>
        </div>
    </div>
</body>
</html><?php }} ?>
