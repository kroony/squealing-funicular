<?php

include_once("bootstrap.php");
include_once("hero/heroController.php");
include_once("user/userController.php");

//html header
$smarty->display("css/css.tpl");

$heroController = new heroController();
$userController = new usercontroller();

//menu
$smarty->assign("currentpage","leaderboard");
include_once("menu.php");
	  
/*********  Get top 10 lists  ***********/

$smarty->assign("XPHeroes", $heroController->getTop10ByXP());

$smarty->assign("KillHeroes", $heroController->getTop10ByKills());

$smarty->assign("OldHeroes", $heroController->getTop10ByAge());

$smarty->assign("DeathUsers", $userController->getBottom10ByDeath());

$smarty->assign("WealthUsers", $userController->getTop10ByGold());

$smarty->assign("KillUsers", $userController->getTop10ByKills());

$smarty->assign("KilltoDeathRatioUsers", $userController->getTop10ByKillToDeathRatio());

/*********  Get top 10 lists  ***********/

$smarty->display("leaderboard.tpl");

?>
