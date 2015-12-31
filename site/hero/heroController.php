<?php

include_once("hero/hero.php");


class heroController
{

  function output($Hero)
  {
    
    echo "</p><br /><strong>" . $Hero->Name ."</strong>";
    echo "<br />ID: " . $Hero->ID;
    echo "<br />OwnerID: " . $Hero->OwnerID;
    echo "<br />PartyID: " . $Hero->PartyID;
    echo "<br />Race: " . $Hero->Race;
    echo "<br />Class: " . $Hero->HeroClass;
    echo "<br />HP: " . $Hero->CurrentHP .'/'. $Hero->MaxHP;
    echo "<br />Level: " . $Hero->Level;
    echo "<br />XP: " . $Hero->CurrentXP .'/'. $Hero->LevelUpXP;
    echo "<br />Str: " . $Hero->Str;
    echo "<br />Dex: " . $Hero->Dex;
    echo "<br />Con: " . $Hero->Con;
    echo "<br />Int: " . $Hero->Intel;
    echo "<br />Wis: " . $Hero->Wis;
    echo "<br />Cha: " . $Hero->Cha;
    echo "<br />Fte: " . $Hero->Fte;
    echo "<br />WeaponID: " . $Hero->WeaponID . "</p>";
  }
  
  function outputInTable($Hero)
  {
    echo "<tr>";
    echo "<td>" . $Hero->Name ."</td>";
    //echo "<td>" . $Hero->OwnerID ."</td>";
    //echo "<td>" . $Hero->PartyID ."</td>";
    echo "<td>" . $Hero->Race->Name ."</td>";
    echo "<td>" . $Hero->HeroClass->Name ."</td>";
    echo "<td>" . $Hero->CurrentHP .'/'. $Hero->MaxHP ."</td>";
    echo "<td>" . $Hero->Level ."</td>";
    echo "<td>" . $Hero->CurrentXP .'/'. $Hero->LevelUpXP ."</td>";
    echo "<td>" . $Hero->Str ."</td>";
    echo "<td>" . $Hero->Dex ."</td>";
    echo "<td>" . $Hero->Con ."</td>";
    echo "<td>" . $Hero->Intel ."</td>";
    echo "<td>" . $Hero->Wis ."</td>";
    echo "<td>" . $Hero->Cha ."</td>";
    echo "<td>" . $Hero->Fte ."</td>";
    echo "<td>" . $Hero->Weapon->Name ." ".$Hero->Weapon->DamageQuantity."d".$Hero->Weapon->DamageDie."+".$Hero->Weapon->DamageOffset."</td>";
    echo "<td><a href='delete.php?ID=" . $Hero->ID . "'>Delete</a></td>";
	if($Hero->CurrentXP == $Hero->LevelUpXP){
		echo "<td><a href='levelUp.php?ID=" . $Hero->ID . "'>Try Level up</a></td>";
	}else{
		echo "<td>Not Enough XP</td>";
	}
    
	if($Hero->CurrentHP < 1 && $Hero->CurrentHP > -$Hero->Con){
		echo "<td><a href='revive.php?ID=" . $Hero->ID . "'>Revive Hero</a></td>";
	}
	else if($Hero->CurrentHP < 1){
		echo "<td>DEAD!</td>";
	}
	else{
		echo "<td></td>";
	}

	if($Hero->CurrentHP > 0){
		echo "<td><a href='oneononechoose.php?ID=" . $Hero->ID . "'>Fight!</a></td>";
	}
	else{
		echo "<td></td>";
	}
  }
  
  function showAll()
  {
    $getQuery = "SELECT `ID` FROM `Hero`;";

    $getResult=mysql_query($getQuery);//execute query
    $totalHeros=mysql_numrows($getResult); 
    echo "Showing " . $totalHeros . " results.<br />";
    
    echo "<table style='width: 100%;'>
            <tr>
              <td>Name</td>
              <!--<td>OwnerID</td>
              <td>PartyID</td>-->
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
              <!--<td>WeaponID</td>-->
              <td>Delete</td>
              <td>Level UP</td>
              <td>Revive</td>
              <td>Fight</td>
            </tr>";
              
    $i=0;
    while($i < $totalHeros)
    {
      $HeroID=mysql_result($getResult,$i,"ID");
      
      $Hero = new Hero();
      $this->outputInTable($Hero->loadHero($HeroID));
      $i++;
    }
    
    echo "</table>";
  }
  
  function showAllForUser($id)
  {
    $getQuery = "SELECT `ID` FROM `Hero` WHERE `OwnerID` = $id;";

    $getResult=mysql_query($getQuery);//execute query
    $totalHeros=mysql_numrows($getResult); 
    echo "Showing " . $totalHeros . " results.<br />";
    
    echo "<table style='width: 100%;'>
            <tr>
              <td>Name</td>
              <!--<td>OwnerID</td>
              <td>PartyID</td>-->
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
              <td>Weapon</td>
              <td>Delete</td>
              <td>Level UP</td>
			  <td>Revive</td>
              <td>Fight</td>
            </tr>";
              
    $i=0;
    while($i < $totalHeros)
    {
      $HeroID=mysql_result($getResult,$i,"ID");
      
      $Hero = new Hero();
      $this->outputInTable($Hero->loadHero($HeroID));
      $i++;
    }
    
    echo "</table>";
  }
  
  function dropDownForUser($id)
  {
    $getQuery = "SELECT `ID`, `Name` FROM `Hero` WHERE `OwnerID` = $id AND `CurrentHP` > 0;";

    $getResult=mysql_query($getQuery);//execute query
    $totalHeros=mysql_numrows($getResult); 
	
	$returnString = "";
    $i=0;
    while($i < $totalHeros)
    {
      $HeroID=mysql_result($getResult,$i,"ID");
      $HeroName=mysql_result($getResult,$i,"Name");
	  
	  $returnString .= "<option value='" . $HeroID . "'>" . $HeroName . "</option>";
      
      $i++;
    }
    return $returnString;
  }
  
  function dropDownForUserEnemys($id)
  {
    $getQuery = "SELECT `ID`, `Name` FROM `Hero` WHERE `OwnerID` <> $id AND `CurrentHP` = `MaxHP`;";

    $getResult=mysql_query($getQuery);//execute query
    $totalHeros=mysql_numrows($getResult); 
	
	$returnString = "";
    $i=0;
    while($i < $totalHeros)
    {
      $HeroID=mysql_result($getResult,$i,"ID");
      $HeroName=mysql_result($getResult,$i,"Name");
	  
	  $returnString .= "<option value='" . $HeroID . "'>" . $HeroName . "</option>";
      
      $i++;
    }
    return $returnString;
  }

  function findEnemys($id, $Hero)
  {
    $low_level = $Hero->Level - 1;
	$high_level = $Hero->Level + 2;
    $getQuery = "SELECT `ID` FROM `Hero` WHERE `OwnerID` <> $id AND `CurrentHP` = `MaxHP` AND `Level` BETWEEN $low_level AND $high_level;";

    $getResult=mysql_query($getQuery);
    $totalHeros=mysql_numrows($getResult); 
	
    $i=0;
	$enemys = array();
    while($i < $totalHeros)
    {
      $HeroID=mysql_result($getResult,$i,"ID");
	  
	  $enemy = new Hero();
	  $enemy = $enemy->loadHero($HeroID);
	  $enemys[] = $enemy;
      
      $i++;
    }
    return $enemys;
  }
  
  function performGlobalHealing($rate)
  {
    $rate = (float)$rate;
    $getQuery = "UPDATE Hero
	SET CurrentHP = LEAST(MaxHP, CurrentHP + (Level + GREATEST(0, FLOOR((Con - 10) / 2))) * $rate)
	WHERE CurrentHP > 0 AND CurrentHP < MaxHP";

    $getResult=mysql_query($getQuery);//execute query
	return $getResult;
  }
}

?>
