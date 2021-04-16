<?php /* Smarty version Smarty-3.1.21-dev, created on 2019-06-04 02:21:13
         compiled from "C:\xampp\htdocs\PROJEKT\templates\registracija.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18619266095cedb83899d052-18798286%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '503dbd751b7cfd2143afaf28716b251cdc718c1e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\PROJEKT\\templates\\registracija.tpl',
      1 => 1559607656,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18619266095cedb83899d052-18798286',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5cedb8389d3a34_71155712',
  'variables' => 
  array (
    'site_key' => 0,
    'emailCheck' => 0,
    'errCaptcha' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cedb8389d3a34_71155712')) {function content_5cedb8389d3a34_71155712($_smarty_tpl) {?><link href="../css/main.css" rel="stylesheet" type="text/css">
<?php echo '<script'; ?>
 src="https://www.google.com/recaptcha/api.js?render=<?php echo $_smarty_tpl->tpl_vars['site_key']->value;?>
"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../js/registracija.js"><?php echo '</script'; ?>
>
</head>
<body class="registerBody" onload="eventHandlerRegistracija()">
    <div class="goBack">
        
        <a class="nav-ul-li-a" href="../index.php"><img src="../assets/backSVG.svg"> Povratak</a></li>
    </div>
        
    <div class="main">
        <div class="screen">
            <div class="title">
                <h3>Registracija</h3>
            </div>

            <form class="form" novalidate method="POST" action="../form/registracija.php">
                <div class="group">
                    <input type="text" class="field" value="" placeholder="ime" name="ime" id="ime">
                    <label class="login-field-icon fui-user" for="im"></label>
                    
                </div>
                <div class="group">
                    <input type="text" class="field" value="" placeholder="prezime" name="prezime" id="prezime">
                    <label class="login-field-icon fui-user" for="prezime"></label>
                </div>
                <div class="group">
                    <input type="text" class="field" value="" placeholder="korisničko ime" name="korime" id="korime">
                    <label class="login-field-icon fui-user" for="korime"></label>
                    <p class="registrationErr">Korisničko ime već postoji, molimo odaberite drugo korisničko ime.</p>
                </div>
                <div class="group">
                    <input type="text" class="field" value="" placeholder="telefon" name="telefon" id="telefon">
                    <label class="login-field-icon fui-user" for="telefon"></label>
                </div>
                <div class="group">
                    <input type="text" class="field" value="" placeholder="email" name="email" id="email">
                    <label class="login-field-icon fui-user" for="email"></label>
                    <p class="registrationErr">E-mail nije ispravnog formata</p>
                    <?php echo $_smarty_tpl->tpl_vars['emailCheck']->value;?>

                </div>
                <div class="group">
                    <input type="password" class="field" value="" placeholder="lozinka" name="lozinka" id="lozinka">
                    <label class="login-field-icon fui-lock" for="lozinka"></label>
                    <p class="registrationErr">Lozinka treba imati najmanje 6 znakova</p>
                </div>
                <div class="group">
                    <input type="password" class="field" value="" placeholder="potvrda lozinke" name="relozinka" id="relozinka">
                    <label class="login-field-icon fui-lock" for="relozinka"></label>
                    <p class="registrationErr">Lozinka se ne podudara</p>
                </div>
                <div class="group">
                    <input type="text" id="g-recaptcha-response" name="g-recaptcha-response">
                    <p class="registrationErr" style="display:block"><?php echo $_smarty_tpl->tpl_vars['errCaptcha']->value;?>
</p>
                    <div class="g-recaptcha" data-sitekey="<?php echo $_smarty_tpl->tpl_vars['site_key']->value;?>
"></div>
                </div>

                <p class="registrationErr">Unesite podatke u sva polja!</p>
                
                <input type="submit" name="submit" value="Registracija" id="submit">
                <a class="login-link" href="prijava.php">Imate račun? Prijavite se ovdje</a>
            </form>
        </div>
    </div>
</body>
</html><?php }} ?>
