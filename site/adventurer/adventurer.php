<?php
/*
//////perhaps have 2 weapons and an armor or 3 items of some sort to make things more indepth, laters problem.
*/

class Adventurer
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
    
    $this->Race = mysql_result($getResult,$i,"Race");
    $this->Name = mysql_result($getResult,$i,"Name");
    $this->AdvClass = mysql_result($getResult,$i,"Class");
    $this->MaxHP = mysql_result($getResult,$i,"MaxHP");
    $this->CurrentHP = mysql_result($getResult,$i,"CurrentHP");
    $this->Level = mysql_result($getResult,$i,"Level");
    $this->CurrentXP = mysql_result($getResult,$i,"CurrentXP");
    $this->LevelUpXP = mysql_result($getResult,$i,"LevelUpXP");
    $this->Str = mysql_result($getResult,$i,"Str");
    $this->Dex = mysql_result($getResult,$i,"Dex");
    $this->Con = mysql_result($getResult,$i,"Con");
    $this->Intel = mysql_result($getResult,$i,"Intel");
    $this->Wis = mysql_result($getResult,$i,"Wis");
    $this->Cha = mysql_result($getResult,$i,"Cha");
    $this->Fte = mysql_result($getResult,$i,"Fte");
    $this->WeaponID = mysql_result($getResult,$i,"WeaponID");
    
    return $this;
    
    
  }
  
  function GenerateAdventurer($level)
  {
    
    $this->Race = $this->GenerateRace();
    $this->Name = $this->GenerateName();
    $this->AdvClass = $this->GenerateAdvClass();
    $this->MaxHP = $level * 10;  //base the multiplyer on class and con
    $this->CurrentHP = $this->MaxHP;
    $this->Level = $level;
    $this->CurrentXP = 100*pow($level - 1, 2);;   //will have to be what ever $LevelUpXP generates as if $level was one less
    $this->LevelUpXP = 100*pow($level, 2);
    $this->Str = $this->GenerateAtribute();//include bonuses argument and level argument
    $this->Dex = $this->GenerateAtribute();
    $this->Con = $this->GenerateAtribute();
    $this->Intel = $this->GenerateAtribute();
    $this->Wis = $this->GenerateAtribute();
    $this->Cha = $this->GenerateAtribute();
    $this->Fte = $this->GenerateAtribute();
    
    //generate weapon
  }
  
  
  function GenerateAtribute()
  {
    /*
    scale a classic 3d6 setup as:
    3d6
    4d6 drop 1
    5d6 drop 2
    4d6
    5d6 drop 1
    6d6 drop 2
    5d6 
    Or something that better?! based on level
    */ 
    
    
    //shitty 4d6 drop 1
    $diceRolled = array(rand(1, 6), rand(1, 6), rand(1, 6), rand(1, 6));
    rsort($diceRolled);
    
    return $diceRolled[0] + $diceRolled[1] + $diceRolled[2];
  }
  
  
  function GenerateAdvClass()
  {
    /*
    Bard - helps recruit new people
    Fighter - Attacks and defends in PVP
    Rogue - helps hide party from other partys and find other parties
    Wizard - Do DPS to "fight" and in PVP
    Cleric - Heals
    */
    $classes = array("Bard", "Fighter", "Rouge", "Wizard", "Cleric");
    
    return $classes[rand(0,4)];
  }
  
  function GenerateName()
  {
    //some cool name generator based on race?
    $fName = array("Throsgrulim", "Yundic", "Havuck", "Maghamli", "Toremrum");
    $lName = array("Snowfall", "Koboldmace", "Plateforge", "Oremace", "Merrymaker");
    return $fName[rand(0,4)] . " " . $lName[rand(0,4)];
  }
  
  function GenerateRace()
  {
    /*
    Human, Dwarf, Elf, Halfling
    */
    $races = array("Human", "Dwarf", "Elf", "Halfling");
    
    return $races[rand(0,3)];
  }
  
  function SaveAdventurer()
  {
    //check shit is ok
    
    //if $ID !== null, update
    $InsertQuery = "INSERT INTO `Adventurer` (`OwnerID`, `PartyID`, `Name`,            `Race`,            `Class`,               `MaxHP`,            `CurrentHP`,            `Level`,            `CurrentXP`,            `LevelUpXP`,            `Str`,            `Dex`,            `Con`,            `Intel`,          `Wis`,            `Cha`,            `Fte`,            `WeaponID`
                                    ) VALUES ('0',       '0',       '".$this->Name."', '".$this->Race."', '".$this->AdvClass."', '".$this->MaxHP."', '".$this->CurrentHP."', '".$this->Level."', '".$this->CurrentXP."', '".$this->LevelUpXP."', '".$this->Str."', '".$this->Dex."', '".$this->Con."', '".$this->Con."', '".$this->Wis."', '".$this->Cha."', '".$this->Fte."', '0');";
    
    
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
