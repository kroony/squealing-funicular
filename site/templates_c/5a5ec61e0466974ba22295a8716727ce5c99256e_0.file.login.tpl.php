<?php
/* Smarty version 3.1.30-dev/14, created on 2016-01-01 10:23:09
  from "/var/kroony/site/login.tpl" */

if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.30-dev/14',
  'unifunc' => 'content_5686538da75dd4_44971544',
  'file_dependency' => 
  array (
    '5a5ec61e0466974ba22295a8716727ce5c99256e' => 
    array (
      0 => '/var/kroony/site/login.tpl',
      1 => 1451618112,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5686538da75dd4_44971544 ($_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['result']->value == "login_error") {?>
	Problem with login Details please try again <a href="index.php">Click Here</a>
<?php } elseif ($_smarty_tpl->tpl_vars['result']->value == "activate") {?>
	Please 1st activate your account before loging in, to do this check in your inbox and follow the activate my account link';
<?php } else { ?>
	Login success, redirecting!
<?php }
}
}
