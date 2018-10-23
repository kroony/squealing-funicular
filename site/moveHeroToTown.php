<?php
include("bootstrap.php");
include_once("hero/heroController.php");

//load User
include_once("user/user.php");
$user = new User();
$user = $user->load($currentUID);


$heroController = new heroController();

$currentTime = new DateTime('now');

$hero = new Hero();
$hero = $hero->loadHero($_REQUEST['ID']);

if($hero->Status != "")
{
  header("Location: guild.php?message=This hero is busy");
  exit;
} else {
  $hero->Location = "town";
  $hero->SaveHero();
  header("Location: town.php");
  exit;
}
?>

