<?php

include("bootstrap.php");
include_once("user/user.php");

$smarty->display("css/css.tpl");

//menu
$smarty->assign("currentpage","classtree");
$smarty->display("menu.tpl");



$smarty->display("classtree.tpl");

