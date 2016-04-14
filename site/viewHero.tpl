<div class="container-fluid">
<div id="heroName"><h3>{$hero->Name} <span class="glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit Name" onclick='document.getElementById("heroName").style.display = "none"; document.getElementById("heroEditName").style.display = "block";'></span></h3></div>

{if isset($message)}
	<div class="alert alert-info">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		{$message}
	</div>
{/if}
{if isset($error)}
	<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		{$error}
	</div>
{/if}

<form id="heroEditName" action="viewHero.php" style="display: none;">
<input type="hidden" name="action" value="editName">
<input type="hidden" name="ID" value="{$hero->ID}">
<input type="text" name="heroName" value="{$hero->Name}">
<input type="submit" value="Submit">
</form>

<div class="row">
	<div class="col-sm-4" >
		{include file='portraits/kobold.html'}
	</div>
	<div class="col-sm-8" >
		Level: {$hero->Level}{if isset($LevelIncrease)} <span class="glyphicon glyphicon-arrow-up" style="color: limegreen;"> +1</span>{/if}<br />
		Race: {$hero->Race->Name} - {$hero->Race->Description}<br />
		Class: {if isset($ClassChange)} After mastering all that a {$ClassChange} can. {$hero->Name} has advanced to <br />{/if}
		<strong>{$hero->HeroClass->Name}</strong><br />
		{$hero->HeroClass->Description}<br />
		<i>"{$hero->HeroClass->Quote}"</i><br />
		<br />
		Age: {$hero->Age} years<br />
		Kills: {$hero->Kills}<br />
	</div>
</div>

<br />
<div class="progress">
  <div class="progress-bar {if $displayHero->CurrentHP == $displayHero->MaxHP} progress-bar-success {elseif $displayHero->CurrentHP < $displayHero->Con} progress-bar-danger {elseif $displayHero->CurrentHP < $displayHero->MaxHP} progress-bar-warning {/if}" 
  role="progressbar" aria-valuenow="{$hero->CurrentHP}" aria-valuemin="0" aria-valuemax="{$hero->MaxHP}" style="width:{$hero->CurrentHP/$hero->MaxHP*100}%">
	<span>
		{$hero->CurrentHP}HP/{$hero->MaxHP}HP{if isset($HPIncrease)} <strong>+{$HPIncrease}</strong>{/if}
		{if $hero->isAlive() == false} <a href='delete.php?ID={$hero->ID}'>Remove</a>{elseif $hero->CurrentHP <= 0} <a href='revive.php?ID={$hero->ID}'>Revive</a>{/if}
	</span>
  </div>
</div><br />

<div class="progress">
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{$hero->CurrentXP}"
  aria-valuemin="0" aria-valuemax="{$hero->LevelUpXP}" id="XPBar" style="width:{if isset($OldXP)}{$OldXP/$hero->LevelUpXP*100}{else}{$hero->CurrentXP/$hero->LevelUpXP*100}{/if}%">
    <span>{number_format($hero->CurrentXP)}XP/{number_format($hero->LevelUpXP)}XP{if $hero->CurrentXP >= $hero->LevelUpXP && $hero->Status == ""} <a href="viewHero.php?action=levelUp&ID={$hero->ID}">Try Level up</a>{/if}</span>
  </div>
</div>
{if isset($OldXP)}
	<script type="text/javascript">
		UpdateBar("XPBar", 0, {$hero->CurrentXP});
	</script>
{/if}
{if $hero->Status == "Level Up" && $hero->StatusETA != 'None'}
	Currently levelling up, <span id="LevelStatusCountdown"></span> remaining.
	<script type="text/javascript">
		countdown( "LevelStatusCountdown", {$hero->getStatusCountdownJSArgs()} );
	</script>
{elseif $hero->Status == "Level Up" && $hero->StatusETA == 'None'}
	<a href="viewHero.php?action=FinishlevelUp&ID={$hero->ID}">Complete Level Up!</a>
{/if}
<br /><br />
<div class="row">
	<div class="col-sm-4" >
		<table class='table table-hover'>
			<thead>
				<tr>
					<th>Attribute</th>
					<th>Value</th>
					<th>Train</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Strength</td>
					<td>{$hero->Str}{if isset($StrIncrease)} <span class="glyphicon glyphicon-arrow-up" style="color: limegreen;"> +1</span>{/if}</td>
					<td>
						{if $hero->Status == ""}
							{if $user->canAfford($hero->calculateAttributeUpgradeCost($hero->Str))}<a href="viewHero.php?action=Train&increase=Str&ID={$hero->ID}"><span class="glyphicon glyphicon-arrow-up"></span></a>{/if} Train for {number_format($hero->calculateAttributeUpgradeCost($hero->Str))}gp
						{elseif $hero->Status == "Train Str" && $hero->StatusETA != 'None'}
							Currently training, <span id="StrStatusCountdown"></span> remaining.
							<script type="text/javascript">
								countdown( "StrStatusCountdown", {$hero->getStatusCountdownJSArgs()} );
							</script>
						{elseif $hero->Status == "Train Str" && $hero->StatusETA == 'None'}
							<a href="viewHero.php?action=FinishTrain&increase=Str&ID={$hero->ID}">Complete Training!</a>
						{/if}
					</td>
				</tr>
				<tr>
					<td>Dexterity</td>
					<td>{$hero->Dex}{if isset($DexIncrease)} <span class="glyphicon glyphicon-arrow-up" style="color: limegreen;"> +1</span>{/if}</td>
					<td>
						{if $hero->Status == ""}
							{if $user->canAfford($hero->calculateAttributeUpgradeCost($hero->Dex))}<a href="viewHero.php?action=Train&increase=Dex&ID={$hero->ID}"><span class="glyphicon glyphicon-arrow-up"></span></a>{/if} Train for {number_format($hero->calculateAttributeUpgradeCost($hero->Dex))}gp
						{elseif $hero->Status == "Train Dex" && $hero->StatusETA != 'None'}
							Currently training, <span id="DexStatusCountdown"></span> remaining.
							<script type="text/javascript">
								countdown( "DexStatusCountdown", {$hero->getStatusCountdownJSArgs()} );
							</script>
						{elseif $hero->Status == "Train Dex" && $hero->StatusETA == 'None'}
							<a href="viewHero.php?action=FinishTrain&increase=Dex&ID={$hero->ID}">Complete Training!</a>
						{/if}
					</td>
				</tr>
				<tr>
					<td>Constitution</td>
					<td>{$hero->Con}{if isset($ConIncrease)} <span class="glyphicon glyphicon-arrow-up" style="color: limegreen;"> +1</span>{/if}</td>
					<td>
						{if $hero->Status == ""}
							{if $user->canAfford($hero->calculateAttributeUpgradeCost($hero->Con))}<a href="viewHero.php?action=Train&increase=Con&ID={$hero->ID}"><span class="glyphicon glyphicon-arrow-up"></span></a>{/if} Train for {number_format($hero->calculateAttributeUpgradeCost($hero->Con))}gp
						{elseif $hero->Status == "Train Con" && $hero->StatusETA != 'None'}
							Currently training, <span id="ConStatusCountdown"></span> remaining.
							<script type="text/javascript">
								countdown( "ConStatusCountdown", {$hero->getStatusCountdownJSArgs()} );
							</script>
						{elseif $hero->Status == "Train Con" && $hero->StatusETA == 'None'}
							<a href="viewHero.php?action=FinishTrain&increase=Con&ID={$hero->ID}">Complete Training!</a>
						{/if}
					</td>
				</tr>
				<tr>
					<td>Intelligence</td>
					<td>{$hero->Intel}{if isset($IntelIncrease)} <span class="glyphicon glyphicon-arrow-up" style="color: limegreen;"> +1</span>{/if}</td>
					<td>
						{if $hero->Status == ""}
							{if $user->canAfford($hero->calculateAttributeUpgradeCost($hero->Intel))}<a href="viewHero.php?action=Train&increase=Intel&ID={$hero->ID}"><span class="glyphicon glyphicon-arrow-up"></span></a>{/if} Train for {number_format($hero->calculateAttributeUpgradeCost($hero->Intel))}gp
						{elseif $hero->Status == "Train Intel" && $hero->StatusETA != 'None'}
							Currently training, <span id="IntelStatusCountdown"></span> remaining.
							<script type="text/javascript">
								countdown( "IntelStatusCountdown", {$hero->getStatusCountdownJSArgs()} );
							</script>
						{elseif $hero->Status == "Train Intel" && $hero->StatusETA == 'None'}
							<a href="viewHero.php?action=FinishTrain&increase=Intel&ID={$hero->ID}">Complete Training!</a>
						{/if}
					</td>
				</tr>
				<tr>
					<td>Wisdom</td>
					<td>{$hero->Wis}{if isset($WisIncrease)} <span class="glyphicon glyphicon-arrow-up" style="color: limegreen;"> +1</span>{/if}</td>
					<td>
						{if $hero->Status == ""}
							{if $user->canAfford($hero->calculateAttributeUpgradeCost($hero->Wis))}<a href="viewHero.php?action=Train&increase=Wis&ID={$hero->ID}"><span class="glyphicon glyphicon-arrow-up"></span></a>{/if} Train for {number_format($hero->calculateAttributeUpgradeCost($hero->Wis))}gp
						{elseif $hero->Status == "Train Wis" && $hero->StatusETA != 'None'}
							Currently training, <span id="WisStatusCountdown"></span> remaining.
							<script type="text/javascript">
								countdown( "WisStatusCountdown", {$hero->getStatusCountdownJSArgs()} );
							</script>
						{elseif $hero->Status == "Train Wis" && $hero->StatusETA == 'None'}
							<a href="viewHero.php?action=FinishTrain&increase=Wis&ID={$hero->ID}">Complete Training!</a>
						{/if}
					</td>
				</tr>
				<tr>
					<td>Charisma</td>
					<td>{$hero->Cha}{if isset($ChaIncrease)} <span class="glyphicon glyphicon-arrow-up" style="color: limegreen;"> +1</span>{/if}</td>
					<td>
						{if $hero->Status == ""}
							{if $user->canAfford($hero->calculateAttributeUpgradeCost($hero->Cha))}<a href="viewHero.php?action=Train&increase=Cha&ID={$hero->ID}"><span class="glyphicon glyphicon-arrow-up"></span></a>{/if} Train for {number_format($hero->calculateAttributeUpgradeCost($hero->Cha))}gp
						{elseif $hero->Status == "Train Cha" && $hero->StatusETA != 'None'}
							Currently training, <span id="ChaStatusCountdown"></span> remaining.
							<script type="text/javascript">
								countdown( "ChaStatusCountdown", {$hero->getStatusCountdownJSArgs()} );
							</script>
						{elseif $hero->Status == "Train Cha" && $hero->StatusETA == 'None'}
							<a href="viewHero.php?action=FinishTrain&increase=Cha&ID={$hero->ID}">Complete Training!</a>
						{/if}
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-sm-8">
		{include file='classtreeSmall.tpl'}
	</div>
</div>

<!-- DEBUG STATUS
	<br />
	<br /><strong>Debug</strong>
	<br />Status: {$hero->Status}
	<br />StatusTime: {$hero->StatusTime->format('Y-m-d H:i:s')}
	<br />NOW: {$currentTime->format("Y-m-d H:m:s")}
	{if $hero->StatusETA != 'None'}
		<br />Difference: <span id="StatusCountdown"></span>
		<script type="text/javascript">
			countdown( "StatusCountdown", {$hero->getStatusCountdownJSArgs()} );
		</script>
	{/if}
	<br />
-->

<br />
<div class="row">
	<div class="col-sm-4" >
		<div class="panel panel-default">
			<div class="panel-heading">
				<div id="weaponNameDiv">Weapon: <b>{$hero->Weapon->Name}</b> <span class="glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit Name"  onclick='document.getElementById("weaponNameDiv").style.display = "none"; document.getElementById("weaponEditNameForm").style.display = "block";' ></span></div>
				<form id="weaponEditNameForm" action="viewHero.php" style="display: none;">
					<input type="hidden" name="action" value="editWeaponName">
					<input type="hidden" name="ID" value="{$hero->ID}">
					<input type="hidden" name="WeaponID" value="{$hero->Weapon->ID}">
					<input type="text" name="weaponName" value="{$hero->Weapon->Name}">
					<input type="submit" value="Submit">
				</form>
			</div>
			<div class="panel-body">
				<!--<i>@TODO: image</i><br />-->
				Damage: {$hero->Weapon->DamageQuantity}d{$hero->Weapon->DamageDie}{if $hero->Weapon->DamageOffset < 0}{$hero->Weapon->DamageOffset}{elseif $hero->Weapon->DamageOffset > 0}+{$hero->Weapon->DamageOffset}{/if}<br />
				Uses: {$hero->Weapon->DamageAttribute} (+{$hero->calculateAttributeBonus($hero->getAttributeByName($hero->Weapon->DamageAttribute))})<br />
				Critical Strike Chance: {$hero->Weapon->CritChance}%<br />
				<br />
				{if isset($unequipedWeapons)}
				Change Weapon:<br />
				<form id="changeWeapon" action="viewHero.php">
					<input type="hidden" name="action" value="changeWeapon">
					<input type="hidden" name="ID" value="{$hero->ID}">
					<select name="WeaponID">
						<option>Select Weapon</option>
						{foreach from=$unequipedWeapons item=weapon}
						<option value="{$weapon->ID}">{$weapon->Name} {$weapon->DamageQuantity}d{$weapon->DamageDie}{if $weapon->DamageOffset < 0}{$weapon->DamageOffset}{elseif $weapon->DamageOffset > 0}+{$weapon->DamageOffset}{/if}</option>
						{/foreach}
					</select>
					<input type="submit" value="Equip">
				</form>
				{/if}
			</div>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="panel panel-default">
			<div class="panel-heading">Armor</div>
			<div class="panel-body">
				Armor Value: <br />
				Additional HP: 
			</div>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="panel panel-default">
			<div class="panel-heading">Item</div>
			<div class="panel-body">
			</div>
		</div>
	</div>
</div>

</div>