<?php

chdir("../");

include_once("bootstrap.php");

include_once("user/userController.php");
include_once("hero/heroController.php");

//html header
$smarty->display("css/css.tpl");

$userController = new userController();
$heroController = new heroController();

//menu
$smarty->display("menu.tpl");

/*********  show all Users  ***********/
$allUsers = $userController->getAll();
$smarty->assign("heroController",$heroController);
$smarty->assign("allUsers",$allUsers);
$smarty->display("admin/users.tpl");
/*********  end show all Users  ***********/

?>
