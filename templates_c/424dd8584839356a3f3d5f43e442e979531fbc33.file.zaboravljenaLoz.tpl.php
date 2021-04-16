<?php /* Smarty version Smarty-3.1.21-dev, created on 2019-05-31 14:17:22
         compiled from "C:\xampp\htdocs\PROJEKT\templates\zaboravljenaLoz.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13939132085cf11b5277fb28-41542970%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '424dd8584839356a3f3d5f43e442e979531fbc33' => 
    array (
      0 => 'C:\\xampp\\htdocs\\PROJEKT\\templates\\zaboravljenaLoz.tpl',
      1 => 1559179127,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13939132085cf11b5277fb28-41542970',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'porukaForgot' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5cf11b529ae144_70781316',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cf11b529ae144_70781316')) {function content_5cf11b529ae144_70781316($_smarty_tpl) {?><link href="../css/main.css" rel="stylesheet" type="text/css">
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
