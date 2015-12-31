<?php

include_once("includes/connect.php");

/*********Add XP*********/
include_once("hero/pitController.php");

$pit = new PitController();


$hero1 = new Hero();
$hero1 = $hero1->loadHero($_REQUEST['ID1']);

$hero2 = new Hero();
$hero2 = $hero2->loadHero($_REQUEST['ID2']);


$pit->oneOnOne($hero1, $hero2);

echo "<br /><br /><br />";

//check for death 
if($hero1->CurrentHP < (0 - $hero1->Con))
{
	//call death function of some sort 
	echo $hero1->Name . " has <b>died</b> in battle<br /><br />";
	echo "<b>" . $hero2->Name . " is victorious!</b><br />";
}
else if($hero1->CurrentHP < 0)
{
	echo $hero1->Name . " has been knocked out in battle<br /><br />";
	echo "<b>" . $hero2->Name . " is victorious!</b><br />";
}

if($hero2->CurrentHP < (0 - $hero2->Con))
{
	//call death function of some sort 
	echo $hero2->Name . " has died in battle<br /><br />";
	echo "<b>" . $hero1->Name . " is victorious!</b><br />";
}
else if($hero2->CurrentHP < 0)
{
	echo $hero2->Name . " has been knocked out in battle<br /><br />";
	echo "<b>" . $hero1->Name . " is victorious!</b><br />";
}

//save heros

$hero1->SaveHero();
if ($hero2->Level != -1)
	$hero2->SaveHero();

//header("Location: index.php");

?>

<a href="home.php">Return</a>