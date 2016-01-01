<?php
/* Smarty version 3.1.30-dev/14, created on 2016-01-01 10:17:40
  from "/var/kroony/site/register.tpl" */

if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.30-dev/14',
  'unifunc' => 'content_5686524439bb35_21430616',
  'file_dependency' => 
  array (
    '53af7c083d4d4797b67d696f528d41d3a67997c7' => 
    array (
      0 => '/var/kroony/site/register.tpl',
      1 => 1451643283,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5686524439bb35_21430616 ($_smarty_tpl) {
if (isset($_smarty_tpl->tpl_vars['error']->value)) {?>
Sorry, that username already exists. <a href="register.php">Try again!</a>

<?php } elseif (isset($_smarty_tpl->tpl_vars['id']->value)) {?>
You have successfully created a new user.
<br />
Your username is "<?php echo $_smarty_tpl->tpl_vars['user']->value;?>
" and your password is "pass".
<br />
You can log in <a href="index.php">here</a>.

<?php } else { ?>
Register a new user!
<br />
<hr>
<br />
<form action="register.php" method="post">
Username: <input name="username" type="text"><br />
<input type="submit" value="Submit">
</form>

<?php }?>




<?php }
}
