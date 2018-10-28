<?php
set_include_path("..");
require_once("includes/database.class.php");
include_once("user/userController.php");
include_once("hero/heroController.php");
include_once("location/locationController.php");

$heroController = new heroController();
$userController = new userController();

$townies = $heroController->getAllInLocation(2); //get all heroes in town
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
      
      $NPCRatRace = new Race("Vermin", 0, 0, 0, 0, 0, 0, 0, 4, "Town Vermin Description");
      $NPCRatHeroClass = new HeroClass("Common", 4, "Str", 5, 0, "Str", 5, 1, "Found all over town", "Squeak");
      
      $NPCTownRatWeapon = new Weapon("Bite", 146, 4, 1, 1, 5, "Str");
      $NPCRat = Hero::makeNPC("Town Rat", $NPCRatRace, $NPCRatHeroClass, rand(6, 12), 1, 6, 12, 6, 2, 10, 8, 10, $NPCTownRatWeapon);
      
      $NPCSewerRatWeapon = new Weapon("Bite", 146, 6, 1, 2, 5, "Str");
      $NPCSewerRat = Hero::makeNPC("Sewer Rat", $NPCRatRace, $NPCRatHeroClass, rand(8, 14), 3, 8, 12, 6, 2, 10, 12, 10, $NPCSewerRatWeapon);
      
      $NPCDireRatWeapon = new Weapon("Bite", 146, 4, 2, 2, 5, "Str");
      $NPCDireRat = Hero::makeNPC("Dire Rat", $NPCRatRace, $NPCRatHeroClass, rand(15, 22), 6, 12, 12, 6, 2, 10, 14, 10, $NPCDireRatWeapon);
      
      $NPC;
      if($hero->Level == 1)       { $NPC = $NPCRat; }
      else if($hero->Level <= 4) { $NPC = $NPCSewerRat; }
      else                       { $NPC = $NPCDireRat; }
      
      
      
      $log = $pit->fightNPC($hero, $NPC);
      
      $msgSubject = "Your Hero, " . $hero->Name . " was attacked by a " . $NPC->Name . " while exploring town.";
      userController::sendMessage($hero->OwnerID, 146, $msgSubject, $log->show(), 1);//send message
      
      if($hero->isAlive() && $hero->CurrentHP <= 0) { $hero->Location->ID = 1; }
      $hero->SaveHero();    
    } else {
      //nothing - nothing
      echo "<br />nothing";
    }
  }
}
echo "<br /><br />";
echo "Healing";
echo "<br /><br />";
$currentLocation = Location::load(3);//load healer
$healies = $heroController->getAllInLocation($currentLocation->ID); //get all heroes in healer
$tmpUser = new User();
foreach($townies as $hero)
{
  echo "<br /><br />";
  echo $hero->Name;
  //TODO:make sure they are not travelling
  $randomOutcome = rand(1,100);
  echo "<br />";
  echo $randomOutcome;
  
  if($randomOutcome <= ($currentLocation->CostChance * 100))
  {
    echo "<br />pay";
    $tmpUser = $tmpUser->load($hero->OwnerID);
    
    if($tmpUser->canAfford($currentLocation->Cost))
    {
      $tmpUser->debit($currentLocation->Cost);
      //male some hero log entry now and then
    } else {
      //move back to guild hall cause they are poor
      $hero->Status = "Traveling";
      $hero->StatusTime = new DateTime(date("Y-m-d H:i:s", strtotime(sprintf("+%d minutes", 1))));
      
      $hero->Location->ID = 1;
      $hero->SaveHero();
    }
  }
}
?>
