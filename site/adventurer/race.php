<?php

class Race
{
  public $Name;
  public $StrBon;
  public $DexBon;
  public $ConBon;
  public $IntelBon;
  public $WisBon;
  public $ChaBon;
  public $FteBon;
  
  function __construct($Name, $StrBon, $DexBon, $ConBon, $IntelBon, $WisBon, $ChaBon, $FteBon)
  {
    $this->Name = $Name;
    $this->StrBon = $StrBon;
    $this->DexBon = $DexBon;
    $this->ConBon = $ConBon;
    $this->IntelBon = $IntelBon;
    $this->WisBon = $WisBon;
    $this->ChaBon = $ChaBon;
    $this->FteBon = $FteBon;
  }
  
  function generateAdventurerName()
  {
    //pull from banks, random 1st name last name by race type
    //some cool name generator based on race?
    $fName = array("Throsgrulim", "Yundic", "Havuck", "Maghamli", "Toremrum");
    $lName = array("Snowfall", "Koboldmace", "Plateforge", "Oremace", "Merrymaker");
    return $fName[rand(0,4)] . " " . $lName[rand(0,4)];
  }
}

?>
