<?php

include_once("bootstrap.php");

/*********Generate Hero*********/
include_once("hero/heroController.php");
$heroController = new heroController();

include_once("user/user.php");
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

	header("Location: viewHero.php?ID=" . $Hero->ID);
}
else
{
	header("Location: home.php"); //@TODO error message for cant afford
}


?>
