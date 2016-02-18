<?php

chdir("../");

include_once("bootstrap.php");
include_once("hero/heroController.php");

//html header
$smarty->display("css/css.tpl");

$heroController = new heroController();

//menu
$smarty->display("menu.tpl");

/*********  show all Hero  ***********/
$Heros = $heroController->getAll();
$smarty->assign("Heros",$Heros);
$smarty->assign("totalHeros",count($Heros));
$smarty->display("admin/heroes.tpl");
/*********  end show all Hero  ***********/

chdir("admin/");

?>
