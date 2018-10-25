<?php
set_include_path("..");
require_once("includes/database.class.php");

include_once("hero/heroController.php");

$heroController = new heroController();
$userController = new userController();

$townies = $heroController->getAllInTown(); //get all heroes in town

$tmpUser = new User();

foreach($townies as $hero)
{
  //TODO:make sure they are not travelling
  
  $randomOutcome = rand(1,100);
  
  if($randomOutcome <= 50)
  {
    //explore - perception check + luck add to user exploration
    echo $hero->OwnerID;
    $tmpUser->load($hero->OwnerID);
    
    $tmpUser->addExploration($hero->rollExplore());
  } else if($randomOutcome > 50 && $randomOutcome <= 60) {
    //fight - fight a pre determined NPC for location, move hero back to guild hall if unconcious
  } else {
    //nothing - nothing
  }
}

/*
  $Town = new Location();
  $Town->Name = "Town";
  $Town->Description = "The town where your guild is located.";
  $Town->RequiredExploration = 0;
  $Town->MinLevel = 0;
  $Town->MaxLevel = 5;
  $Town->RewardType = "Town-Exploration";
  $Town->RewardChance = 0.5;
  $Town->NPCFightChance = 0.1;
  $Town->Distance = 0;
  $Town->Cost = 0;
  $Town->Hidden = false;
  $Town->Page = "town.php";
  $Town->PageName = "Town";
*/
?>
