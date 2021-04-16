<?php /* Smarty version Smarty-3.1.21-dev, created on 2019-06-04 10:44:49
         compiled from "C:\xampp\htdocs\PROJEKT\templates\podnozje.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11340873975cedb65648fef7-79591807%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c7fdef8e20c0a1666651dc61a2b2bd7e3606f1af' => 
    array (
      0 => 'C:\\xampp\\htdocs\\PROJEKT\\templates\\podnozje.tpl',
      1 => 1559637887,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11340873975cedb65648fef7-79591807',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5cedb65649f9b3_63361118',
  'variables' => 
  array (
    'vrijeme' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cedb65649f9b3_63361118')) {function content_5cedb65649f9b3_63361118($_smarty_tpl) {?><footer class="foot">
    <div class="links">
      <h4>Links</h4>
      <hr>
      <ul>
        <li>Početna</li>
        <li><a href="o_autoru.html">O autoru</a></li>
        <li><a href="dokumentacija.html">Dokumentacija</li>
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
