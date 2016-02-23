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
<br />
{include file='portraits/kobold.html'}
<br />
Level: {$hero->Level}{if isset($LevelIncrease)} <span class="glyphicon glyphicon-arrow-up" style="color: limegreen;"> +1</span>{/if}<br />
Race: {$hero->Race->Name} - {$hero->Race->Description}<br />
Class: {if isset($ClassChange)} After mastering all that a {$ClassChange} can. {$hero->Name} has advanced to <br />{/if}
<strong>{$hero->HeroClass->Name}</strong><br />{$hero->HeroClass->Description}<br /><i>"{$hero->HeroClass->Quote}"</i><br />
<div class="progress">
  <div class="progress-bar {if $displayHero->CurrentHP == $displayHero->MaxHP} progress-bar-success {elseif $displayHero->CurrentHP < $displayHero->Con} progress-bar-danger {elseif $displayHero->CurrentHP < $displayHero->MaxHP} progress-bar-warning {/if}" 
  role="progressbar" aria-valuenow="{$hero->CurrentHP}" aria-valuemin="0" aria-valuemax="{$hero->MaxHP}" style="width:{$hero->CurrentHP/$hero->MaxHP*100}%">
	<span>
		{$hero->CurrentHP}HP/{$hero->MaxHP}HP{if isset($HPIncrease)} <strong>+{$HPIncrease}</strong>{/if}
		{if $hero->CurrentHP <= -$hero->Con} <a href='delete.php?ID={$hero->ID}'>Remove</a>{elseif $hero->CurrentHP <= 0} <a href='revive.php?ID={$hero->ID}'>Revive</a>{/if}
	</span>
  </div>
</div><br />

<div class="progress">
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{$hero->CurrentXP}"
  aria-valuemin="0" aria-valuemax="{$hero->LevelUpXP}" id="XPBar" style="width:{if isset($OldXP)}{$OldXP/$hero->LevelUpXP*100}{else}{$hero->CurrentXP/$hero->LevelUpXP*100}{/if}%">
    <span>{number_format($hero->CurrentXP)}XP/{number_format($hero->LevelUpXP)}XP{if $hero->CurrentXP >= $hero->LevelUpXP} <a href="viewHero.php?action=levelUp&ID={$hero->ID}">Try Level up</a>{/if}</span>
  </div>
</div>
{if isset($OldXP)}
<script type="text/javascript">
UpdateBar("XPBar", 0, {$hero->CurrentXP});
</script>
{/if}
<br />
Strength: {$hero->Str}
	{if isset($StrIncrease)} <span class="glyphicon glyphicon-arrow-up" style="color: limegreen;"> +1</span> Strength has increased!{/if} 
	{if $hero->Status == ""}
		<a href="viewHero.php?action=Train&increase=Str&ID={$hero->ID}">Train for {number_format($hero->calculateAttributeUpgradeCost($hero->Str))}gp</a>
	{elseif $hero->Status == "Train Str" && $hero->StatusETA != 'None'}
		Currently training, <span id="StrStatusCountdown"></span> remaining.
		<script type="text/javascript">
			countdown( "StrStatusCountdown", {$hero->getStatusCountdownJSArgs()} );
		</script>
	{elseif $hero->Status == "Train Str" && $hero->StatusETA == 'None'}
		<a href="viewHero.php?action=FinishTrain&increase=Str&ID={$hero->ID}">Complete Training!</a>
	{/if}
<br />
Dexterity: {$hero->Dex}
	{if isset($DexIncrease)} <span class="glyphicon glyphicon-arrow-up" style="color: limegreen;"> +1</span> Dexterity has increased!{/if}
<br />
Constitution: {$hero->Con}
	{if isset($ConIncrease)} <span class="glyphicon glyphicon-arrow-up" style="color: limegreen;"> +1</span> Constitution has increased!{/if}
<br />
Intelligence: {$hero->Intel}
	{if isset($IntelIncrease)} <span class="glyphicon glyphicon-arrow-up" style="color: limegreen;"> +1</span> Intelligence has increased!{/if}
<br />
Wisdom: {$hero->Wis}
	{if isset($WisIncrease)} <span class="glyphicon glyphicon-arrow-up" style="color: limegreen;"> +1</span> Wisdom has increased!{/if}
<br />
Charisma: {$hero->Cha}
	{if isset($ChaIncrease)} <span class="glyphicon glyphicon-arrow-up" style="color: limegreen;"> +1</span> Charisma has increased!{/if}
<br />
<br /><strong>Statistics</strong>
<br />Age: {$hero->Age} years
<br />Kills: {$hero->Kills}
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
{include file='classtreeSmall.tpl'}
<br />
<div class="row">
	<div class="col-sm-4" >
		<div class="panel panel-default">
			<div class="panel-heading">
				<div id="weaponNameDiv"><b>{$hero->Weapon->Name}</b> <span class="glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit Name"  onclick='document.getElementById("weaponNameDiv").style.display = "none"; document.getElementById("weaponEditNameForm").style.display = "block";' ></span></div>
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
					<input type="submit" value="Submit">
				</form>
				{/if}
			</div>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="panel panel-default">
			<div class="panel-heading">Armor</div>
			<div class="panel-body">
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