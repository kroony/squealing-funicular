<?php

class Race
{
  public $ID;
  public $Name;
  public $StrBon;
  public $DexBon;
  public $ConBon;
  public $IntelBon;
  public $WisBon;
  public $ChaBon;
  public $FteBon;
  public $OldAge;
  public $Description;
  //abilities or more unique bonuses?
  
  function __construct($Name, $StrBon, $DexBon, $ConBon, $IntelBon, $WisBon, $ChaBon, $FteBon, $OldAge, $Description)
  {
    $this->Name = $Name;
    $this->StrBon = $StrBon;
    $this->DexBon = $DexBon;
    $this->ConBon = $ConBon;
    $this->IntelBon = $IntelBon;
    $this->WisBon = $WisBon;
    $this->ChaBon = $ChaBon;
    $this->FteBon = $FteBon;
    $this->OldAge = $OldAge;
    $this->Description = $Description;
  }
  
  //load Race from DB 
  function loadRace($ID)
  {
    //check ID is not blank and exists and such
    
    $getQuery = "SELECT * FROM `Race` WHERE `ID` = '" . $ID . "';";

    $getResult=mysql_query($getQuery);//execute query
    $num=mysql_numrows($getResult);
    
    $ReturnRace = new Race(mysql_result($getResult,0,"Name"), 
                           mysql_result($getResult,0,"StrBon"), 
                           mysql_result($getResult,0,"DexBon"), 
                           mysql_result($getResult,0,"ConBon"), 
                           mysql_result($getResult,0,"IntelBon"), 
                           mysql_result($getResult,0,"WisBon"), 
                           mysql_result($getResult,0,"ChaBon"), 
                           mysql_result($getResult,0,"FteBon"), 
                           mysql_result($getResult,0,"OldAge"), 
                           mysql_result($getResult,0,"Description"));
    
    $ReturnRace->ID = $ID;
    
    return $ReturnRace;
  }
  
  function generateHeroName()
  {
    //pull from banks, random 1st name last name by race type
    //some cool name generator based on race?
    $fName = array("Throsgrulim", "Yundic", "Havuck", "Maghamli", "Toremrum");
    $lName = array("Snowfall", "Koboldmace", "Plateforge", "Oremace", "Merrymaker");
    return $fName[rand(0,4)] . " " . $lName[rand(0,4)];
  }
}

?>
