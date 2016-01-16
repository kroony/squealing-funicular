<?php

include("bootstrap.php");

$smarty->display("css/css.tpl");


//menu
$smarty->display("menu.tpl");


include_once("user/user.php");

$user = new User();
$user = $user->load($currentUID);
$smarty->assign("user",$user);

$smarty->display("user.tpl");

