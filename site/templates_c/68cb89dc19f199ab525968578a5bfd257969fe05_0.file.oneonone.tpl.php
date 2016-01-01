<?php
/* Smarty version 3.1.30-dev/14, created on 2016-01-01 11:11:26
  from "/var/kroony/site/oneonone.tpl" */

if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.30-dev/14',
  'unifunc' => 'content_56865ede412556_23364636',
  'file_dependency' => 
  array (
    '68cb89dc19f199ab525968578a5bfd257969fe05' => 
    array (
      0 => '/var/kroony/site/oneonone.tpl',
      1 => 1451618112,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_56865ede412556_23364636 ($_smarty_tpl) {
?>
<br /><br /><br />

<?php if ($_smarty_tpl->tpl_vars['hero1']->value->CurrentHP < (0-$_smarty_tpl->tpl_vars['hero1']->value->Con)) {?>
	<?php echo $_smarty_tpl->tpl_vars['hero1']->value->Name;?>
 has <b>died</b> in battle<br /><br />
	<b><?php echo $_smarty_tpl->tpl_vars['hero2']->value->Name;?>
 is victorious!</b><br />
<?php } elseif ($_smarty_tpl->tpl_vars['hero1']->value->CurrentHP > 0) {?>
	<?php echo $_smarty_tpl->tpl_vars['hero1']->value->Name;?>
 has been knocked out in battle<br /><br />
	<b><?php echo $_smarty_tpl->tpl_vars['hero2']->value->Name;?>
 is victorious!</b><br />
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['hero2']->value->CurrentHP < (0-$_smarty_tpl->tpl_vars['hero2']->value->Con)) {?>
	<?php echo $_smarty_tpl->tpl_vars['hero2']->value->Name;?>
 has died in battle<br /><br />
	<b><?php echo $_smarty_tpl->tpl_vars['hero1']->value->Name;?>
  is victorious!</b><br />
<?php } elseif ($_smarty_tpl->tpl_vars['hero2']->value->CurrentHP < 0) {?>
	<?php echo $_smarty_tpl->tpl_vars['hero2']->value->Name;?>
 has been knocked out in battle<br /><br />
	<b><?php echo $_smarty_tpl->tpl_vars['hero1']->value->Name;?>
 is victorious!</b><br />
<?php }?>

<a href="home.php">Return</a>
<?php }
}
