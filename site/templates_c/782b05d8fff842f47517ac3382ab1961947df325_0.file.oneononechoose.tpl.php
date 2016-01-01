<?php
/* Smarty version 3.1.30-dev/14, created on 2016-01-01 11:11:24
  from "/var/kroony/site/oneononechoose.tpl" */

if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.30-dev/14',
  'unifunc' => 'content_56865edc5276b9_31821108',
  'file_dependency' => 
  array (
    '782b05d8fff842f47517ac3382ab1961947df325' => 
    array (
      0 => '/var/kroony/site/oneononechoose.tpl',
      1 => 1451645574,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_56865edc5276b9_31821108 ($_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['hero']->value->Name;?>
 (level <?php echo $_smarty_tpl->tpl_vars['hero']->value->Level;?>
) would like to fight:<br />

<table>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['against']->value, 'ag');
foreach ($_from as $_smarty_tpl->tpl_vars['ag']->value) {
$_smarty_tpl->tpl_vars['ag']->_loop = true;
$__foreach_ag_0_saved = $_smarty_tpl->tpl_vars['ag'];
?>
        <!--$owner = mysql_get_rows("SELECT * FROM `User` WHERE ID = " . $ag->OwnerID);
		To get the username add this as property to the $ag object-->
        <tr>
          <td><a href="oneonone.php?ID1=<?php echo $_smarty_tpl->tpl_vars['hero']->value->ID;?>
&ID2=<?php echo $_smarty_tpl->tpl_vars['ag']->value->ID;?>
"><?php echo $_smarty_tpl->tpl_vars['ag']->value->Name;?>
</a></td>
          <td>Level <?php echo $_smarty_tpl->tpl_vars['ag']->value->Level;?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['ag']->value->Race->Name;?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['ag']->value->HeroClass->Name;?>
</td>
          <td>Owner ID: <?php echo $_smarty_tpl->tpl_vars['ag']->value->OwnerID;?>
</td>
        </tr>
<?php
$_smarty_tpl->tpl_vars['ag'] = $__foreach_ag_0_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
</table>

<a href="home.php">Return</a>
<?php }
}
