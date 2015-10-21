<?php

include_once("adventurer/adventurer.php");


class adventurerController
{

  function output($Adventurer)
  {
    
    echo "</p><br /><strong>" . $Adventurer->Name ."</strong>";
    echo "<br />ID: " . $Adventurer->ID;
    echo "<br />OwnerID: " . $Adventurer->OwnerID;
    echo "<br />PartyID: " . $Adventurer->PartyID;
    echo "<br />Race: " . $Adventurer->Race;
    echo "<br />Class: " . $Adventurer->AdvClass;
    echo "<br />HP: " . $Adventurer->CurrentHP .'/'. $Adventurer->MaxHP;
    echo "<br />Level: " . $Adventurer->Level;
    echo "<br />XP: " . $Adventurer->CurrentXP .'/'. $Adventurer->LevelUpXP;
    echo "<br />Str: " . $Adventurer->Str;
    echo "<br />Dex: " . $Adventurer->Dex;
    echo "<br />Con: " . $Adventurer->Con;
    echo "<br />Int: " . $Adventurer->Intel;
    echo "<br />Wis: " . $Adventurer->Wis;
    echo "<br />Cha: " . $Adventurer->Cha;
    echo "<br />Fte: " . $Adventurer->Fte;
    echo "<br />WeaponID: " . $Adventurer->WeaponID . "</p>";
  }
  
  function showAll()
  {
    $getQuery = "SELECT `ID` FROM `Adventurer`;";

    $getResult=mysql_query($getQuery);//execute query
    $totalAdventurers=mysql_numrows($getResult); 
    echo "Showing " . $totalAdventurers . " results.<br />";
    
    $i=0;
    while($i < $totalAdventurers)
    {
      $AdventurerID=mysql_result($getResult,$i,"ID");
      
      $Adventurer = new Adventurer();
      $this->output($Adventurer->loadAdventurer($AdventurerID));
      echo "<hr>";
      $i++;
    }
  }
}

?>
