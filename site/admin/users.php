<?php

chdir("../");

include_once("bootstrap.php");
include_once("user/userController.php");

//html header
$smarty->display("css/css.tpl");

$userController = new userController();

//menu
$smarty->display("menu.tpl");

/*********  show all Party  ***********/
$users = $userController->getAll();
$smarty->assign("users",$users);
$smarty->display("admin/users.tpl");
/*********  end show all Party  ***********/

chdir("admin/");

?>
