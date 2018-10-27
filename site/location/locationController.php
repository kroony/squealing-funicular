<?php
include_once("location/location.php");

class locationController
{
  public $AllLocations;
  public $UnlockedLocations;
  
  function __construct($UserExploration)
	{
    $AllLocations = array();
    $UnlockedLocations = array();
    
    //Guild Hall - default heros page
    $Guild = new Location();
    $Guild->Name = "Guild Hall";
    $Guild->Description = "All your heroes are safe in the guild hall, this is a good place to be while resting up for more adventuring.";
    $Guild->RequiredExploration = 0;
    $Guild->MinLevel = 0;
    $Guild->MaxLevel = 500;
    $Guild->RewardType = "None";
    $Guild->RewardChance = 0;
    $Guild->NPCFightChance = 0;
    $Guild->Distance = 0;
    $Guild->Cost = 0;
    $Guild->Hidden = false;
    $Guild->Page = "guild.php";
    $Guild->PageName = "Guild Hall";
    array_push($AllLocations, $Guild);
    array_push($UnlockedLocations, $Guild);
    
    //Town - place to look for more places
    $Town = new Location();
    $Town->Name = "Town";
    $Town->Description = "All your heroes exploring town help to finding new locations, but while in town they run the risk of being attacked.";
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
    array_push($AllLocations, $Town);
    array_push($UnlockedLocations, $Town);
    
    //Healer - place to revive heros faster
    $Healer = new Location();
    $Healer->Name = "Healer";
    $Healer->Description = "The town's local healer, heroes located at the healer will recover HP at twice the rate. Occasionally the Healer will ask for a donation, dismissing anyone that cant afford to pay.";
    $Healer->RequiredExploration = 5000;
    $Healer->MinLevel = 0;
    $Healer->MaxLevel = 5;
    $Healer->RewardType = "None";
    $Healer->RewardChance = 0;
    $Healer->NPCFightChance = 0;
    $Healer->Distance = 30;
    $Healer->Cost = 0;
    $Healer->Hidden = false;
    $Healer->Page = "healer.php";
    $Healer->PageName = "Healer";
    array_push($AllLocations, $Healer);
    if($Healer->RequiredExploration <= $UserExploration) { array_push($UnlockedLocations, $Healer); }
    
    //str trainer
    //dex trainer
    //con trainer
    //int trainer
    //wis trainer
    //cha trainer
    
    //gold mine
    //fight pits
    
    
	}
	
	function isUnlockedForUser($locationName)
	{
    
	}
}

?>
