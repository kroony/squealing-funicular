<?php

include_once("bootstrap.php");

include_once("hero/hero.php");

//@TODO add undead races to DB and change current race to matching Undead Race

$Hero = new Hero();
$Hero = $Hero->loadHero($_REQUEST['heroID']);

if($Hero->GetOwner()->ID == $currentUID)
{
	if($_REQUEST['heroName'] != "" && $_REQUEST['heroName'] != null)
	{
		$Hero->Name = $_REQUEST['heroName'];

		$Hero->SaveHero();

		header("Location: viewHero.php?ID=" . $Hero->ID);
	}
	else
	{
		echo "name cant be blank";
	}
}
else
{
	echo "This isn't yours to rename.";
}
