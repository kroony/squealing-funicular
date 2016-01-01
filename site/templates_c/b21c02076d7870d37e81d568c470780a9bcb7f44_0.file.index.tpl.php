<?php
/* Smarty version 3.1.30-dev/14, created on 2016-01-01 10:18:37
  from "/var/kroony/site/index.tpl" */

if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.30-dev/14',
  'unifunc' => 'content_5686527da7faa1_73908222',
  'file_dependency' => 
  array (
    'b21c02076d7870d37e81d568c470780a9bcb7f44' => 
    array (
      0 => '/var/kroony/site/index.tpl',
      1 => 1451618112,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5686527da7faa1_73908222 ($_smarty_tpl) {
?>
<a href="register.php">Register here</a> if you do not already have an account.<br />
<hr>
<br />
<form action="login.php">
  Username: <input name="username" type="text"><br />
  password: <input name="password" type="password"><br />
  <input type="submit" value="Submit">
</form>
<?php }
}
