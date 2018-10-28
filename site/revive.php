<?php
include("bootstrap.php");

/*********Add XP*********/
include_once("hero/hero.php");
include_once("user/user.php");

$hero = new Hero();
$hero = $hero->loadHero($_REQUEST['ID']);

$user = new User();
$user = $user->load($hero->OwnerID);

$reviveCost = $hero->calculateReviveCost();
if($user->canAfford($reviveCost))
{
  $user->debit($reviveCost);
  $hero->revive();
  $hero->SaveHero();
  
  header("Location: healer.php?message=" . $hero->Name . " has been revived.");
  exit;
}
else
{
  header("Location: healer.php?message=Can not afford to revive " . $hero->Name);
  exit;
}			
