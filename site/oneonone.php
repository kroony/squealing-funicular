<?php

include_once("bootstrap.php");

/*********Add XP*********/
include_once("hero/pitController.php");

$pit = new PitController();

$hero1 = new Hero();
$hero1 = $hero1->loadHero($_REQUEST['ID1']);

$smarty->assign("displayHero",$hero1);
$smarty->display("displayHeroComabt.tpl");

$hero2 = new Hero();
$hero2 = $hero2->loadHero($_REQUEST['ID2']);

$smarty->assign("displayHero",$hero2);
$smarty->display("displayHeroComabt.tpl");

$log = $pit->oneOnOne($hero1, $hero2);



$smarty->assign("log",$log);
$smarty->assign("hero1",$hero1);
$smarty->assign("hero1_name",$hero1->displayName(true));
$smarty->assign("hero2",$hero2);
$smarty->assign("hero2_name",$hero2->displayName(false));

$smarty->display("oneonone.tpl");


//save heros
$hero1->SaveHero();
if ($hero2->Level != -1)
{
	$hero2->SaveHero();
}
else //Monster AI
{
  if($hero2->CurrentXP >= $hero2->LevelUpXP)
  {
	//level up
	$preXP = $hero2->LevelUpXP;
	$hero2->LevelUp();
	$hero2->Level = -1;
	$hero2->LevelUpXP = $preXP + 200;
  }
  else
  {
	/*if($hero2->CurrentHP > 0)//if still concious, heal
	{
		$hero2->CurrentHP = $hero2->MaxHP;
	}*/
  }
  $hero2->SaveHero();
}

