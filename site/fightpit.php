<?php

include("bootstrap.php");
include_once("user/user.php");

$smarty->display("css/css.tpl");

//menu
$smarty->assign("currentpage","fightpit");
include_once("menu.php");



$smarty->display("fightpit.tpl");

