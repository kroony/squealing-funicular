<?php
chdir("../");
include_once("bootstrap.php");
include_once("user/user.php");
include_once("hero/hero.php");
$user = new User();
$user = $user->load($currentUID);
		
$Hero = new Hero();
$Hero = $Hero->loadHero($_REQUEST['HeroID']);

if($Hero->OwnerID == $currentUID)//check user owns message
{
  echo $Hero->CurrentHP;
}
else
{
  echo "That hero does not belong to you.";
}