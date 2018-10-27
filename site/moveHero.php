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
}


if(!isset($_REQUEST['dest']))
{
  header("Location: guild.php?message=Bad Destination");
  exit;
}

include_once("location/locationController.php");
$locationController = new LocationController();

$destination = Location::load($_REQUEST['dest']);
$unlockedLocations = $locationController->getUnlockedLocations($user->exploration);

$found = false;
foreach($unlockedLocations as $location)
{
  if($location->ID == $destination->ID) { $found = true; }
}

if(!$found)
{
  header("Location: guild.php?message=Destination not Found");
  exit;
}


$travelDistance = max($hero->Location->Distance, $destination->Distance) - min($hero->Location->Distance, $destination->Distance);

if($travelDistance > 0)
{
  $hero->Status = "Traveling";
  $hero->StatusTime = new DateTime(date("Y-m-d H:i:s", strtotime(sprintf("+%d minutes", $travelDistance))));
}


$hero->Location = $destination;
$hero->SaveHero();

header("Location: " . $hero->Location->URL);
exit;
?>

