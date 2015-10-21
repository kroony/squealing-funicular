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
  
  function outputInTable($Adventurer)
  {
    echo "<tr>";
    echo "<td>" . $Adventurer->Name ."</td>";
    echo "<td>" . $Adventurer->OwnerID ."</td>";
    echo "<td>" . $Adventurer->PartyID ."</td>";
    echo "<td>" . $Adventurer->Race ."</td>";
    echo "<td>" . $Adventurer->AdvClass ."</td>";
    echo "<td>" . $Adventurer->CurrentHP .'/'. $Adventurer->MaxHP ."</td>";
    echo "<td>" . $Adventurer->Level ."</td>";
    echo "<td>" . $Adventurer->CurrentXP .'/'. $Adventurer->LevelUpXP ."</td>";
    echo "<td>" . $Adventurer->Str ."</td>";
    echo "<td>" . $Adventurer->Dex ."</td>";
    echo "<td>" . $Adventurer->Con ."</td>";
    echo "<td>" . $Adventurer->Intel ."</td>";
    echo "<td>" . $Adventurer->Wis ."</td>";
    echo "<td>" . $Adventurer->Cha ."</td>";
    echo "<td>" . $Adventurer->Fte ."</td>";
    echo "<td>" . $Adventurer->WeaponID ."</td>";
    echo "<td><a href='delete.php?ID=" . $Adventurer->ID . "'>Delete</a></td>";
  }
  
  function showAll()
  {
    $getQuery = "SELECT `ID` FROM `Adventurer`;";

    $getResult=mysql_query($getQuery);//execute query
    $totalAdventurers=mysql_numrows($getResult); 
    echo "Showing " . $totalAdventurers . " results.<br />";
    
    echo "<table>
            <tr>
              <td>Name</td>
              <td>OwnerID</td>
              <td>PartyID</td>
              <td>Race</td>
              <td>Class</td>
              <td>HP</td>
              <td>Level</td>
              <td>XP</td>
              <td>Str</td>
              <td>Dex</td>
              <td>Con</td>
              <td>Int</td>
              <td>Wis</td>
              <td>Cha</td>
              <td>Fte</td>
              <td>WeaponID</td>
              <td>Delete</td>
            </tr>";
              
    $i=0;
    while($i < $totalAdventurers)
    {
      $AdventurerID=mysql_result($getResult,$i,"ID");
      
      $Adventurer = new Adventurer();
      $this->outputInTable($Adventurer->loadAdventurer($AdventurerID));
      $i++;
    }
    
    echo "</table>";
  }
}

?>
