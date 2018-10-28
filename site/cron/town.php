<?php
set_include_path("..");
require_once("includes/database.class.php");
include_once("user/userController.php");
include_once("hero/heroController.php");

$heroController = new heroController();
$userController = new userController();

$townies = $heroController->getAllInTown(); //get all heroes in town

$tmpUser = new User();

foreach($townies as $hero)
{
  echo "<br /><br />";
  echo $hero->Name;
  //TODO:make sure they are not travelling
  
  if($hero->canFight())//make sure they are concious and such
  {
    $randomOutcome = rand(1,100);
    echo "<br />";
    echo $randomOutcome;
    
    if($randomOutcome <= 50)
    {
      echo "<br />explore";
      //explore - perception check + luck add to user exploration
      $tmpUser = $tmpUser->load($hero->OwnerID);
      $hero->addXP(0,1);//add 1XP for exploring
      $hero->SaveHero();
      $tmpUser = $tmpUser->addExploration($hero->rollExplore());
      
    } else if($randomOutcome > 50 && $randomOutcome <= 60) {
      echo "<br />fight";
      //fight - fight a pre determined NPC for location, move hero back to guild hall if unconcious
      include_once("hero/pitController.php");
      $pit = new PitController();

      $NPCRat = new Hero();
      $NPCRat->OwnerID = 146;
      $NPCRat->Name = "Town Rat";
      $NPCRat->Race = new Race("Vermin", 0, 0, 0, 0, 0, 0, 0, 4, "Town Rat Description");
      $NPCRat->HeroClass = new HeroClass("Common", 4, "Str", 5, 0, "Str", 5, 1, "Found all over town", "Squeak");
      $NPCRat->MaxHP = rand(6,12);
      $NPCRat->CurrentHP = $NPCRat->MaxHP;
      $NPCRat->Level = 1;
      $NPCRat->CurrentXP = 0;
      $NPCRat->LevelUpXP = 100;
      $NPCRat->Str = 4;
      $NPCRat->Dex = 12;
      $NPCRat->Con = 6;
      $NPCRat->Intel = 2;
      $NPCRat->Wis = 10;
      $NPCRat->Cha = 8;
      $NPCRat->Fte = 10;
      $NPCRat->Weapon;
      $NPCRat->Kills = rand(10000, 100000);
      $NPCRat->Age = 1;
      
      $log = $pit->fightNPC($hero, $NPCRat);
      
      $msgSubject = "Your Hero, " . $hero->Name . " was attacked by a rat while exploring town.";
      userController::sendMessage($hero->OwnerID, 146, $msgSubject, $log->show(), 0);//send message
      
      if($hero->isAlive() && $hero->CurrentHP <= 0) { $hero->Location->ID = 1; }
      $hero->SaveHero();    
    } else {
      //nothing - nothing
      echo "<br />nothing";
    }
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
