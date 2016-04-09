<?php

include("bootstrap.php");
include_once("user/user.php");

$smarty->display("css/css.tpl");

//menu
$smarty->assign("currentpage","classtree");
include_once("menu.php");



$smarty->display("classtree.tpl");

