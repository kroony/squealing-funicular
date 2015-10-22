<?php

include_once("race.php");
include_once("advClass.php");

class Adventurer
/*
//////perhaps have 2 weapons and an armor or 3 items of some sort to make things more indepth, laters problem.
/////// Death from old age? max age based on race? 1day IRL = 1 year
*/
{
  public $ID;
  public $OwnerID;
  public $PartyID;
  public $Name;
  public $Race;
  public $AdvClass;
  public $MaxHP;
  public $CurrentHP;
  public $Level;
  public $CurrentXP;
  public $LevelUpXP;
  public $Str;
  public $Dex;
  public $Con;
  public $Intel;
  public $Wis;
  public $Cha;
  public $Fte;
  public $WeaponID;
  
  function __construct()
  {

  }
  
  //load Adventurer from DB 
  function loadAdventurer($ID)
  {
    
    $this->ID = $ID;
    //check ID is not blank and exists and such
    $getQuery = "SELECT * FROM `Adventurer` WHERE `ID` = '".$this->ID."';";

    $getResult=mysql_query($getQuery);//execute query
    $num=mysql_numrows($getResult);
    
    $this->Race = mysql_result($getResult,0,"Race");//load object
    $this->Name = mysql_result($getResult,0,"Name");
    $this->AdvClass = mysql_result($getResult,0,"Class");//load object
    $this->MaxHP = mysql_result($getResult,0,"MaxHP");
    $this->CurrentHP = mysql_result($getResult,0,"CurrentHP");
    $this->Level = mysql_result($getResult,0,"Level");
    $this->CurrentXP = mysql_result($getResult,0,"CurrentXP");
    $this->LevelUpXP = mysql_result($getResult,0,"LevelUpXP");
    $this->Str = mysql_result($getResult,0,"Str");
    $this->Dex = mysql_result($getResult,0,"Dex");
    $this->Con = mysql_result($getResult,0,"Con");
    $this->Intel = mysql_result($getResult,0,"Intel");
    $this->Wis = mysql_result($getResult,0,"Wis");
    $this->Cha = mysql_result($getResult,0,"Cha");
    $this->Fte = mysql_result($getResult,0,"Fte");
    $this->WeaponID = mysql_result($getResult,0,"WeaponID");
    
    return $this;
  }
  
  function GenerateAdventurer($level)// change to generate all characters at level 1 then call level up from a loop to add levels
  {
    //Race
    $this->Race = $this->GenerateRace();
    echo "Race: " . $this->Race->Name . "<br />";
    
    //Name
    $this->Name = $this->Race->generateAdventurerName();
    echo "Name: " . $this->Name . "<br />";
    
    //Attributes
    echo "Str ";
    $this->Str = $this->GenerateAtribute($this->Race->StrBon);//include bonuses argument and level argument
    echo "Dex ";
    $this->Dex = $this->GenerateAtribute($this->Race->DexBon);
    echo "Con ";
    $this->Con = $this->GenerateAtribute($this->Race->ConBon);
    echo "Int ";
    $this->Intel = $this->GenerateAtribute($this->Race->IntelBon);
    echo "Wis ";
    $this->Wis = $this->GenerateAtribute($this->Race->WisBon);
    echo "Cha ";
    $this->Cha = $this->GenerateAtribute($this->Race->ChaBon);
    echo "Fte ";
    $this->Fte = $this->GenerateAtribute($this->Race->FteBon);
    
    //Class
    $this->AdvClass = $this->GenerateAdvClass();
    echo "<br />Class: " . $this->AdvClass->Name . " HD: D" . $this->AdvClass->HD . "<br />";
    
    //HP
    $this->MaxHP = $this->AdvClass->HD + $this->calculateAttributeBonus($this->Con);  //base the multiplyer on HD and con
    $this->CurrentHP = $this->MaxHP;
    echo "Hit Points: " . $this->CurrentHP . "/" . $this->MaxHP . "<br />";
    
    //Level
    $this->Level = 1;
    echo "Level:" . $this->Level . "<br />";
    
    //XP
    $XPBonus = rand(0, $this->Fte);
    $this->CurrentXP = 0;
    $this->LevelUpXP = 100 - $XPBonus;
    echo "XP: " . $this->CurrentXP . "/" . $this->LevelUpXP . " Luck Bonus: " . $XPBonus . "<br />";
    
    //check for levelup
    if($level - 1 > 0)
    {
      $i=0;
      while($i < $level - 1)
      {
        if($this->Level == $this->AdvClass->LevelCap)
        {
          echo "<br />At " . $this->AdvClass->Name . " level cap, Trying to find new class<br />";
          if($this->AdvClass->checkForNewClass($this))
          {
            //we found a new class and have applied it. now we can level
            echo "Have chosen class: " . $this->AdvClass->Name . "<br />";
            $this->forceLevelUP();
          }
          else
          {
            //no new class. have reached level cap.
            echo "Dont meet the requirements for any classes. :(<br />";
            //can break out of the loop here cause nothing is going to change, looping is a waste of time
            break;
          }
          //search for new class
        }
        else
        {
          $this->forceLevelUP();
        }
        $i++;
      }
    }
    
    //generate weapon
  }
  
  function levelUP()
  {
    //TBD XP checks
    $this->forceLevelUP();
  }
  
  function forceLevelUP()//same as level up without the checks
  {
    //increase level
    $this->Level += 1;
    echo "<br /><br /><strong>Leveling to " . $this->Level . "</strong><br />";
    
    //add hp
    $extraHP = rand(1,$this->AdvClass->HD) + $this->calculateAttributeBonus($this->Con);
    if($extraHP < 1)//minimum 1 hitpoint increase.
    {
      $extraHP = 1;
    }
    $this->MaxHP += $extraHP;
    $this->CurrentHP = $this->MaxHP; //healed when leveled up?? could be exploited....
    echo "Adding " . $extraHP . " HP. Rolled a d" . $this->AdvClass->HD . "+" . $this->calculateAttributeBonus($this->Con) . "<br />";
    
    //increase XP cap
    $this->CurrentXP = $this->LevelUpXP;
    //how much bonus do they already have?
    $currentXPBonus = (100 * pow($this->Level -1, 2)) - $this->LevelUpXP;
    //calc new bonus
    $newXPBonus = 0;
    $i=0;
    while($i < $this->Level)
    {
      $newXPBonus += rand(0, $this->Fte); //level D fate (1d6 -> foo D bar)
      $i++;
    }
    $this->LevelUpXP = (100 * pow($this->Level, 2)) - $currentXPBonus - $newXPBonus;
    echo "New XP cap:" . $this->LevelUpXP . " XP Bonus this Level: " . $newXPBonus . "<br />";
        
    //increase 1 attribute
    $possibleAttribute = array("Str", "Dex", "Con", "Intel", "Wis", "Cha", "Fte");//dynamiclly create this array using a Class favoured Attribute, weighted with Fate
    $pickAttribute = $possibleAttribute[rand(0, count($possibleAttribute)) -1];
    if      ($pickAttribute == "Str") {$this->Str++; echo "Increase Str<br />";}
    else if($pickAttribute == "Dex") {$this->Dex++; echo "Increase Dex<br />";}
    else if($pickAttribute == "Con") {$this->Con++; echo "Increase Con<br />";}
    else if($pickAttribute == "Intel") {$this->Intel++; echo "Increase Intel<br />";}
    else if($pickAttribute == "Wis") {$this->Wis++; echo "Increase Wis<br />";}
    else if($pickAttribute == "Cha") {$this->Cha++; echo "Increase Cha<br />";}
    else if($pickAttribute == "Fte") {$this->Fte++; echo "Increase Fte<br />";}
  }
  
  function calculateAttributeBonus($attribute)
  {
    $bonus = floor(($attribute - 10) / 2);
    
    return $bonus;
  }
  
  
  function GenerateAtribute($bonus)
  {  
    //shitty 4d6 drop 1
    $diceRolled = array(rand(1, 6), rand(1, 6), rand(1, 6), rand(1, 6));
    rsort($diceRolled);
    
    echo "Attribute Dice: " . $diceRolled[0] . ", " . $diceRolled[1] . ", " . $diceRolled[2] . " +" . $bonus . " Drop: " . $diceRolled[3] . " ";
    
    $attribute = $diceRolled[0] + $diceRolled[1] + $diceRolled[2] + $bonus;
    echo "<strong>Total: " . $attribute . " Bonus: " . $this->calculateAttributeBonus($attribute) . "</strong><br />";

    return $attribute;
  }
  
  
  function GenerateAdvClass()//all characters start as commoners
  {
    //change to load(by name "commoner")
    $commoner = new AdvClass("Commoner", 4, 5, 0, "Str", 0, "A commoner come to start an exciting life in adventuring.");
    
    return $commoner;
  }
  
  function GenerateRace()
  {
    //races should put in DB
    $human = new Race("Human",        0,  0,  0,  0,  0,  0,  2);
    $dwarf = new Race("Dwarf",        0,  0,  2,  0,  2, -2,  0);
    $elf = new Race("Elf",            0,  2, -2,  2,  0,  0,  0);
    $halfling = new Race("Halfling", -2,  2,  0,  0,  0,  2,  0);
    
    $races = array($human, $dwarf, $elf, $halfling);
    
    $newRace = $races[rand(0,3)];
    
    return $newRace;
  }
  
  function SaveAdventurer()
  {
    //check shit is ok
    
    //if $ID !== null, update
    $InsertQuery = "INSERT INTO `Adventurer` (`OwnerID`, `PartyID`, `Name`,            `Race`,                  `Class`,                     `MaxHP`,            `CurrentHP`,            `Level`,            `CurrentXP`,            `LevelUpXP`,            `Str`,            `Dex`,            `Con`,            `Intel`,          `Wis`,            `Cha`,            `Fte`,            `WeaponID`
                                    ) VALUES ('0',       '0',       '".$this->Name."', '".$this->Race->Name."', '".$this->AdvClass->Name."', '".$this->MaxHP."', '".$this->CurrentHP."', '".$this->Level."', '".$this->CurrentXP."', '".$this->LevelUpXP."', '".$this->Str."', '".$this->Dex."', '".$this->Con."', '".$this->Intel."', '".$this->Wis."', '".$this->Cha."', '".$this->Fte."', '0');";
    
    mysql_query($InsertQuery);
    
    //some sort of try catch
  }
  
  function GetAllAdventurers()
  {
    //return array of all adventurers in DB
  }
  
  /*function Adventurer($OwnerID, $PartyID, $Name, $Race, $Class, $MaxHP, $CurrentHP, $Level, $CurrentXP, $LevelUpXP, $Str, $Dex, $Con, $Intel, $Wis, $Cha, $Fte, $WeaponID)
  {
    this->$ID = $ID
    this->$OwnerID = $OwnerID
    this->$PartyID = $PartyID
    this->$Name = $Name
    this->$Race = $Race
    this->$AdvClass = $AdvClass
    this->$MaxHP = $MaxHP
    this->$CurrentHP = $CurrentHP
    this->$Level = $Level
    this->$CurrentXP = $CurrentXP
    this->$LevelUpXP = $LevelUpXP
    this->$Str = $Str
    this->$Dex = $Dex
    this->$Con = $Con
    this->$Intel = $Intel
    this->$Wis = $Wis
    this->$Cha = $Cha
    this->$Fte = $Fte
    this->$WeaponID = $WeaponID
  }*/
  
}

?>
