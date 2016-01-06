<?php

include("bootstrap.php");

/*********Add XP*********/
include_once("hero/hero.php");

$hero = new Hero();
$hero = $hero->loadHero($_REQUEST['ID']);

if($hero->Str >= $hero->Dex && $hero->Str >= $hero->Intel && $hero->Str >= $hero->Wis){
  $hero->Weapon = Weapon::generateStartingWeapon($hero->GetOwner()->ID, "Str");
} else if($hero->Dex >= $hero->Str && $hero->Dex >= $hero->Intel && $hero->Dex >= $hero->Wis) {
  $hero->Weapon = Weapon::generateStartingWeapon($hero->GetOwner()->ID, "Dex");
} else if($hero->Intel >= $hero->Str && $hero->Intel >= $hero->Dex && $hero->Intel >= $hero->Wis) {
  $hero->Weapon = Weapon::generateStartingWeapon($hero->GetOwner()->ID, "Intel");
} else if($hero->Wis >= $hero->Str && $hero->Wis >= $hero->Dex && $hero->Wis >= $hero->Intel) {
  $hero->Weapon = Weapon::generateStartingWeapon($hero->GetOwner()->ID, "Wis");
} else {
  //not sure this should happen
  echo "<b>Bill check your highest attribute picker</b>";
}
//save weapon 
$hero->Weapon->save();
		
$hero->SaveHero();

//header("Location: home.php");
header('Location: ' . $_SERVER['HTTP_REFERER']);//dont do this at home kids
