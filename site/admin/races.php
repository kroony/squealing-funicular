<?php
chdir("../");

include_once("bootstrap.php");
include_once("hero/heroController.php");

//html header
$smarty->display("css/css.tpl");

$heroController = new heroController();

//menu
$smarty->display("menu.tpl");

/*********  show all Party  ***********/
$allRaces = $heroController->getAllRaces();
$smarty->assign("allRaces",$allRaces);
$smarty->display("admin/races.tpl");
/*********  end show all Party  ***********/

chdir("admin/");
?>