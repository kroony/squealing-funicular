<?php
set_include_path("..");
require_once("includes/database.class.php");

include_once("hero/heroController.php");

$heroController = new heroController();

/*
find all heros in town

calc instance -  reward 0.5 / fight 0.1 / nothing 0.4 

reward - perception check + luck add to user exploration
fight - fight a pre determined NPC for location, move hero back to guild hall if unconcious
nothing - nothing


/********************
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
