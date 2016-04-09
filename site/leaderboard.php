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
$smarty->display("menu.tpl");
	  
/*********  show all Hero  ***********/

$XPHeroes = $heroController->getTop10ByXP();
$smarty->assign("XPHeroes",$XPHeroes);

$KillHeroes = $heroController->getTop10ByKills();
$smarty->assign("KillHeroes",$KillHeroes);


$DeathUsers = $userController->getBottom10ByDeath();
$smarty->assign("DeathUsers",$DeathUsers);

$WealthUsers = $userController->getTop10ByGold();
$smarty->assign("WealthUsers",$WealthUsers);

$smarty->display("leaderboard.tpl");

/*********  end show all Hero  ***********/


?>
