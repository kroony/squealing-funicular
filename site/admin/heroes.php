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

//set dob
$now = new DateTime('now');
echo $now->format('Y-m-d H:i:s');
foreach($Heros as &$hero)
{
	$hero->DateOfBirth = new DateTime('now');
	$hero->SaveHero();
}


$smarty->assign("Heros",$Heros);
$smarty->assign("totalHeros",count($Heros));
$smarty->display("admin/heroes.tpl");
/*********  end show all Hero  ***********/

chdir("admin/");

?>
