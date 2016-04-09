<?php

include_once("bootstrap.php");
include_once("hero/heroController.php");

//html header
$smarty->display("css/css.tpl");

$heroController = new heroController();

//menu
$smarty->assign("currentpage","leaderboard");
$smarty->display("menu.tpl");
	  
/*********  show all Hero  ***********/

$XPHeroes = $heroController->getTop10ByXP();
$smarty->assign("XPHeroes",$XPHeroes);

$KillHeroes = $heroController->getTop10ByKills();
$smarty->assign("KillHeroes",$KillHeroes);

$DeathUsers = getBottom10ByDeath();
$smarty->assign("DeathUsers",$DeathUsers);

$WealthUsers = getTop10ByGold();
$smarty->assign("WealthUsers",$WealthUsers);

$smarty->display("leaderboard.tpl");

/*********  end show all Hero  ***********/


?>
