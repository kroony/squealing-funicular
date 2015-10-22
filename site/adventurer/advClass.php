<?php
class AdvClass
{
  /*
  Bard - helps recruit new people
  Fighter - Attacks and defends in PVP
  Rogue - helps hide party from other partys and find other parties
  Wizard - Do DPS to "fight" and in PVP?
  Cleric - Heals
  
  $bard = new AdvClass("Bard", 6);
  $fighter = new AdvClass("Fighter", 10);
  $rouge = new AdvClass("Rouge", 8);
  $wizard = new AdvClass("Wizard", 4);
  $cleric = new AdvClass("Cleric", 8);
  */
  
  /*in x levels you "complete" your current class and if you meet the pre reqs you change class to a prestige class
  with more HD, if you dont meet the requirements you have reached level cap
  */
  public $ID;
  public $Name;
  public $HD;
  public $LevelCap;
  public $PrerequisiteLevel;
  public $PrerequisiteAttribute;
  public $PrerequisiteTarget;
  public $Description;
  
  function __construct($Name, $HD, $LevelCap, $PrerequisiteLevel, $PrerequisiteAttribute, $PrerequisiteTarget, $Description)
  {
    $this->Name = $Name;
    $this->HD = $HD;
    $this->LevelCap = $LevelCap;
    $this->PrerequisiteLevel = $PrerequisiteLevel;
    $this->PrerequisiteAttribute = $PrerequisiteAttribute;
    $this->PrerequisiteTarget = $PrerequisiteTarget;
    $this->Description = $Description;
  }
  
  function checkForNewClass($adventurer)
  {
    /*checks for classes we could move to.
    returns false if unsuccessful
    returns true AND makes the change if successful
    perhaps this shouldnt be called CHECK if it DOES something?
    */
    
    //get all classes where PrerequisiteLevel = current level
    $getQuery = "SELECT * FROM `AdvClass` WHERE `PrerequisiteLevel` ='".$adventurer->Level."';";

    $getResult=mysql_query($getQuery);//execute query
    $num=mysql_numrows($getResult);
    
    //filter out the unavalible classes
    $possibleNewClasses = array();
    $i=0;
    while($i < $num)
    {
      $PrerequisiteAttribute = mysql_result($getResult,$i,"PrerequisiteAttribute");
      $PrerequisiteTarget = mysql_result($getResult,$i,"PrerequisiteTarget");
      echo mysql_result($getResult,$i,"Name") . " a needs " . $PrerequisiteTarget . " in " . $PrerequisiteAttribute . " Hero has " . $adventurer->Str . " " . $adventurer->Dex . " " . $adventurer->Con . " " . $adventurer->Intel . " " . $adventurer->Wis . " " . $adventurer->Cha . " " . $adventurer->Fte . "<br />";

      if(($PrerequisiteAttribute == "Str" && $PrerequisiteTarget <= $adventurer->Str) ||
         ($PrerequisiteAttribute == "Dex" && $PrerequisiteTarget <= $adventurer->Dex) ||
         ($PrerequisiteAttribute == "Con" && $PrerequisiteTarget <= $adventurer->Con) ||
         ($PrerequisiteAttribute == "Intel" && $PrerequisiteTarget <= $adventurer->Intel) ||
         ($PrerequisiteAttribute == "Wis" && $PrerequisiteTarget <= $adventurer->Wis) ||
         ($PrerequisiteAttribute == "Cha" && $PrerequisiteTarget <= $adventurer->Cha) ||
         ($PrerequisiteAttribute == "Fte" && $PrerequisiteTarget <= $adventurer->Fte))
      {
        $tmpClass = new AdvClass(mysql_result($getResult,$i,"Name"), mysql_result($getResult,$i,"HD"), mysql_result($getResult,$i,"LevelCap"), mysql_result($getResult,$i,"PrerequisiteLevel"), mysql_result($getResult,$i,"PrerequisiteAttribute"), mysql_result($getResult,$i,"PrerequisiteTarget"), mysql_result($getResult,$i,"Description"));
        array_push($possibleNewClasses, $tmpClass);
      }
      $i++;
    }
    
    //check if there are any new possible new classes
    if(!empty($possibleNewClasses))
    {
      $newClassCount = count($possibleNewClasses);
      //there are new classes, pick one and copy it over
      $newClassIndex = rand(0,$newClassCount -1);
      $newClass = $possibleNewClasses[$newClassIndex];
      
      //$this->ID       should load properly from DB or update the parent adventurer in db or something
      $this->Name = $newClass->Name;
      $this->HD = $newClass->HD;
      $this->LevelCap = $newClass->LevelCap;
      $this->PrerequisiteLevel = $newClass->PrerequisiteLevel;
      $this->PrerequisiteAttribute = $newClass->PrerequisiteAttribute;
      $this->PrerequisiteTarget = $newClass->PrerequisiteTarget;
      $this->Description = $newClass->Description;
      //we changed the class, return true
      return true;
    }
      
    //no new class, return false
    return false;
    
  }
  
  function loadAdvClass($ID)
  {
    //get data from DB given ID
  }
}

?>
