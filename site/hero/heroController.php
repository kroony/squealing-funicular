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
		echo "<br />WeaponID: " . $Hero->WeaponID . "</p>";
	}

	function outputInTable($Hero)
	{
		//fix for single quotes in names
		$fixedName =  str_replace("'", "", $Hero->Name);
		if($fixedName != $Hero->Name)
		{
			$Hero->Name = $fixedName;
			$Hero->SaveHero();
		}
		//end fix
		
		echo "<tr>";
		echo "<td><a href='viewHero.php?ID=" . $Hero->ID . "'>" . $Hero->Name ."</a></td>";
		//echo "<td>" . $Hero->OwnerID ."</td>";
		//echo "<td>" . $Hero->PartyID ."</td>";
		echo "<td>" . $Hero->Race->Name ."</td>";
		echo "<td>" . $Hero->HeroClass->Name ."</td>";
		
		//@TODO , pretty disgusting make into nicer Smarty Templates
		if($Hero->CurrentHP < 1 && $Hero->CurrentHP > -$Hero->Con){
			echo '<td><div class="progress" style="display: inline-flex;width: 300px; position: relative;">
				  <div class="progress-bar progress-bar-warning" role="progressbar" 
				  aria-valuenow="' . $Hero->CurrentHP . '" aria-valuemin="0" aria-valuemax="' . $Hero->MaxHP . '" style="width:' . $Hero->CurrentHP / $Hero->MaxHP * 100 . '%">
					<span>' . $Hero->CurrentHP . 'HP/' . $Hero->MaxHP . 'HP <a href="revive.php?ID=' . $Hero->ID . '">Revive</a></span>
				  </div>
				</div></td>';
		}
		else if($Hero->CurrentHP < 1){
			echo '<td><div class="progress" style="display: inline-flex;width: 300px; position: relative;">
				  <div class="progress-bar progress-bar-warning" role="progressbar" 
				  aria-valuenow="' . $Hero->CurrentHP . '" aria-valuemin="0" aria-valuemax="' . $Hero->MaxHP . '" style="width:' . $Hero->CurrentHP / $Hero->MaxHP * 100 . '%">
					<span>' . $Hero->CurrentHP . 'HP/' . $Hero->MaxHP . 'HP <a href="delete.php?ID=' . $Hero->ID . '">Remove</a></span>
				  </div>
				</div></td>';
		}
		else
		{
			if($Hero->CurrentHP == $Hero->MaxHP)
			{
				echo '<td><div class="progress" style="display: inline-flex;width: 300px; position: relative;">
				  <div class="progress-bar progress-bar-success" role="progressbar" 
				  aria-valuenow="' . $Hero->CurrentHP . '" aria-valuemin="0" aria-valuemax="' . $Hero->MaxHP . '" style="width:' . $Hero->CurrentHP / $Hero->MaxHP * 100 . '%">
					<span>' . $Hero->CurrentHP . 'HP/' . $Hero->MaxHP . 'HP</span>
				  </div>
				</div></td>';
			}
			else if($Hero->CurrentHP < $Hero->Con)
			{
				echo '<td><div class="progress" style="display: inline-flex;width: 300px; position: relative;">
				  <div class="progress-bar progress-bar-danger" role="progressbar" 
				  aria-valuenow="' . $Hero->CurrentHP . '" aria-valuemin="0" aria-valuemax="' . $Hero->MaxHP . '" style="width:' . $Hero->CurrentHP / $Hero->MaxHP * 100 . '%">
					<span>' . $Hero->CurrentHP . 'HP/' . $Hero->MaxHP . 'HP</span>
				  </div>
				</div></td>';
			}
			else if($Hero->CurrentHP < $Hero->MaxHP)
			{
				echo '<td><div class="progress" style="display: inline-flex;width: 300px; position: relative;">
				  <div class="progress-bar progress-bar-warning" role="progressbar" 
				  aria-valuenow="' . $Hero->CurrentHP . '" aria-valuemin="0" aria-valuemax="' . $Hero->MaxHP . '" style="width:' . $Hero->CurrentHP / $Hero->MaxHP * 100 . '%">
					<span>' . $Hero->CurrentHP . 'HP/' . $Hero->MaxHP . 'HP</span>
				  </div>
				</div></td>';
			}
			else
			{
				echo '<td><div class="progress" style="display: inline-flex;width: 300px; position: relative;">
				  <div class="progress-bar progress-bar-success" role="progressbar" 
				  aria-valuenow="' . $Hero->CurrentHP . '" aria-valuemin="0" aria-valuemax="' . $Hero->MaxHP . '" style="width:' . $Hero->CurrentHP / $Hero->MaxHP * 100 . '%">
					<span>' . $Hero->CurrentHP . 'HP/' . $Hero->MaxHP . 'HP</span>
				  </div>
				</div></td>';
			}
		}
		
		
		echo "<td>" . $Hero->Level ."</td>";
		if($Hero->CurrentXP >= $Hero->LevelUpXP)
		{
			echo '<td>
				<div class="progress" style="display: inline-flex;width: 300px; position: relative;">
					<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="' . $Hero->CurrentXP .'"
					aria-valuemin="0" aria-valuemax="'. $Hero->LevelUpXP .'" style="width:'. $Hero->CurrentXP / $Hero->LevelUpXP * 100 . '%">
						<span>' . $Hero->CurrentXP . 'XP/' . $Hero->LevelUpXP . 'XP <a href="levelUp.php?ID=' . $Hero->ID . '">Try Level up</a></span>
					</div>
				</div></td>';
		}
		else
		{
			echo '<td>
				<div class="progress" style="display: inline-flex;width: 300px; position: relative;">
					<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="' . $Hero->CurrentXP .'"
					aria-valuemin="0" aria-valuemax="'. $Hero->LevelUpXP .'" style="width:'. $Hero->CurrentXP / $Hero->LevelUpXP * 100 . '%">
						<span>' . $Hero->CurrentXP . 'XP/' . $Hero->LevelUpXP . 'XP</span>
					</div>
				</div></td>';
		}

		echo "<td>" . $Hero->Str ."</td>";
		echo "<td>" . $Hero->Dex ."</td>";
		echo "<td>" . $Hero->Con ."</td>";
		echo "<td>" . $Hero->Intel ."</td>";
		echo "<td>" . $Hero->Wis ."</td>";
		echo "<td>" . $Hero->Cha ."</td>";
		if($Hero->Weapon->ID < 10){
			echo '<td><a href="generateWeapon.php?ID='. $Hero->ID . '">' . $Hero->Weapon->Name ." ".$Hero->Weapon->DamageQuantity."d".$Hero->Weapon->DamageDie."+".$Hero->Weapon->DamageOffset . ' - Generate New</a></td>';
		}
		else{
			echo "<td>" . $Hero->Weapon->Name ." ".$Hero->Weapon->DamageQuantity."d".$Hero->Weapon->DamageDie."+".$Hero->Weapon->DamageOffset."</td>";
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
		$db = DB::GetConn();

		$getQuery = "SELECT `ID` FROM `Hero`;";
		$getResult=$db->query($getQuery);

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
			<!--<td>WeaponID</td>-->
			<td>Level UP</td>
			<td>Revive</td>
			<td>Fight</td>
			</tr>";

		$rowCount = 0;
		while($obj = $getResult->fetchObject())
		{
			$Hero = new Hero();
			$this->outputInTable($Hero->loadHero($obj->ID));
			$rowCount++;
		}

		echo "<br>Showing " . $rowCount . " results.<br />";

		echo "</table>";
	}

	function showAllForUser($id)
	{
		$db = DB::GetConn();

		$getQuery = "SELECT * FROM `Hero` WHERE `OwnerID` = $id;";

		$res=$db->query($getQuery);//execute query

		echo "<table class='table table-condensed table-hover'>
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
			<td>Weapon</td>
			<td>Fight</td>
			</tr>";

		$totalHeros = 0;
		while($obj = $res->fetchObject())
		{
			$Hero = new Hero();
			$this->outputInTable($Hero->loadHeroFromObject($obj));
			$totalHeros++;
		}
		echo "Showing " . $totalHeros . " results.<br />";

		echo "</table>";

		return $totalHeros;
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
		$db = DB::GetConn();
		$getQuery = "SELECT Hero.* FROM `Hero` WHERE `OwnerID` <> $id AND `CurrentHP` = `MaxHP` AND (`Level` BETWEEN $low_level AND $high_level OR `Level` = -1);";

		$res = $db->query($getQuery);

		$enemys = array();
		while($obj = $res->fetchObject())
		{
			$enemy = new Hero();
			$enemy = $enemy->loadHeroFromObject($obj);
			$enemys[] = $enemy;
		}
		return $enemys;
	}

	function performGlobalHealing($rate)
	{
		$rate = (float)$rate;
		$db = DB::GetConn();
		$getQuery = "UPDATE Hero
			SET CurrentHP = LEAST(MaxHP, CurrentHP + (Level + GREATEST(0, FLOOR((Con - 10) / 2))) * $rate)
			WHERE CurrentHP > 0 AND CurrentHP < MaxHP";

		$getResult=$db->query($getQuery);//execute query
		return $getResult;
	}
}

?>
