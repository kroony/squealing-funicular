<?php
class AdvClass
{
  /*
  Bard - helps recruit new people
  Fighter - Attacks and defends in PVP
  Rogue - helps hide party from other partys and find other parties
  Wizard - Do DPS to "fight" and in PVP?
  Cleric - Heals
  */
  
  /*in x levels you "complete" your current class and if you meet the pre reqs you change class to a prestige class
  with more HD, if you dont meet the requirements you have reached level cap
  */
  public $Name;
  public $HD;
  //Max level
  //Prerequisites
  
  
  function __construct($Name, $HD)
  {
    $this->Name = $Name;
    $this->HD = $HD;
  }
}

?>
