<?php

include_once("bootstrap.php");

/*********Generate Hero*********/
include_once("hero/heroController.php");
$heroController = new heroController();

include_once("user/userController.php");
$userController = new userController();
$user = new User();
$user = $user->load($currentUID);

$newHeroCost = $heroController->getCostForNextHero($currentUID);
if($user->canAfford($newHeroCost))
{
	$user->gold -= $newHeroCost;
	$user->Save();
	
	$Hero = new Hero();

	$Hero->GenerateHero(1); // $_REQUEST["level"]); //generate lvl1 Hero

	$Hero->GiveToUser($currentUID);
	$Hero->generateStartingWeapon();//@TODO move this into hero controller so it can follow the correct process (create, give, weapon, ect)
	//save hero
	$Hero->SaveHero();

	/***********end generate Hero *********/
	
	//check for referer bonus
	if($newHeroCost > 0 && $user->refererID != 0)
	{
		$refererUser = new User();
		$refererUser = $refererUser->load($user->refererID);
		
		$recruitmentBonus = ceil($newHeroCost / 10);
		$refererUser->credit($recruitmentBonus);
		
		$userController->sendMessage($refererUser->ID, $user->ID, "Recruitment Bonus of " . $recruitmentBonus . " gp", $user->username . " hired a new hero, earning you " . $recruitmentBonus . "gp");
	}

	header("Location: viewHero.php?ID=" . $Hero->ID);
}
else
{
	header("Location: home.php"); //@TODO error message for cant afford
}


?>
