<?php

include_once("bootstrap.php");
include_once("hero/heroController.php");

//html header
$smarty->display("css/css.tpl");

$heroController = new heroController();

//menu
$smarty->assign("currentpage","home");
$smarty->display("menu.tpl");
	  
/*********  show all Hero  ***********/

$totalHeros = $heroController->showAllForUser($currentUID);
$smarty->assign("totalHeros",$totalHeros);
$smarty->display("home.tpl");

		  
/*********  end show all Hero  ***********/


?>
