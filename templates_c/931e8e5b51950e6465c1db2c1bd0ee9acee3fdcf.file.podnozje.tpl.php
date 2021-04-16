<?php /* Smarty version Smarty-3.1.21-dev, created on 2019-06-04 11:45:13
         compiled from "/var/www/webdip.barka.foi.hr/2018/zadaca_01/rsudec/projekt/templates/podnozje.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1232911155cf6386e82a249-64286267%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '931e8e5b51950e6465c1db2c1bd0ee9acee3fdcf' => 
    array (
      0 => '/var/www/webdip.barka.foi.hr/2018/zadaca_01/rsudec/projekt/templates/podnozje.tpl',
      1 => 1559641506,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1232911155cf6386e82a249-64286267',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5cf6386e82ca60_66104904',
  'variables' => 
  array (
    'vrijeme' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cf6386e82ca60_66104904')) {function content_5cf6386e82ca60_66104904($_smarty_tpl) {?><footer class="foot">
    <div class="links">
      <h4>Links</h4>
      <hr>
      <ul>
        <li>Početna</li>
        <li><a href="o_autoru.html">O autoru</a></li>
        <li><a href="dokumentacija.html">Dokumentacija</a></li>
      </ul>
    </div>
    <div class="time">
      <?php echo $_smarty_tpl->tpl_vars['vrijeme']->value;?>

    </div>
    <div class="contact">
      <h4>Kontakt</h4>
      <hr>
      <ul>
        <li>Robert Sudec</li>
        <li>rsudec@foi.hr</li>
        <li>Faculty of</li>
        <li>Organization</li>
        <li>and Informatics</li>
      </ul>
    </div>
  </footer>
</body>
</html>
<?php }} ?>
