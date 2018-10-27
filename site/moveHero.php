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


if(!isset($_REQUEST['dest']))
{
  header("Location: guild.php?message=Bad Destination");
  exit;
}

$destination = $_REQUEST['dest'];

if($hero->Status != "")
{
  header("Location: guild.php?message=This hero is busy");
  exit;
} else {
  //destination picker
  if($destination == 2)
  {
    $hero->Location = 2;
    $hero->SaveHero();
    header("Location: town.php");
    exit;
  } else if($destination == 1) {
    $hero->Location = 1;
    $hero->SaveHero();
    header("Location: guild.php");
    exit;
  }
  header("Location: guild.php?message=Bad Destination");
  exit;
}
?>

