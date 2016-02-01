<div class="container-fluid">
<div id="heroName"><h3>{$hero->Name} <img src="images/icons/pencil_24.png" onclick='document.getElementById("heroName").style.display = "none"; document.getElementById("heroEditName").style.display = "block";' /></h3></div>

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
Level: {$hero->Level}<br />
Race: {$hero->Race->Name} - {$hero->Race->Description}<br />
Class: {$hero->HeroClass->Name} - {$hero->HeroClass->Description}<br />
<div class="progress">
  <div class="progress-bar {if $displayHero->CurrentHP == $displayHero->MaxHP} progress-bar-success {elseif $displayHero->CurrentHP < $displayHero->Con} progress-bar-danger {elseif $displayHero->CurrentHP < $displayHero->MaxHP} progress-bar-warning {/if}" 
  role="progressbar" aria-valuenow="{$hero->CurrentHP}" aria-valuemin="0" aria-valuemax="{$hero->MaxHP}" style="width:{$hero->CurrentHP/$hero->MaxHP*100}%">
	<span>{$hero->CurrentHP}HP/{$hero->MaxHP}HP{if $hero->CurrentHP <= -$hero->Con} <a href='delete.php?ID={$hero->ID}'>Remove</a>{elseif $hero->CurrentHP <= 0} <a href='revive.php?ID={$hero->ID}'>Revive</a>{/if}</span>
  </div>
</div><br />

<div class="progress">
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{$hero->CurrentXP}"
  aria-valuemin="0" aria-valuemax="{$hero->LevelUpXP}" style="width:{$hero->CurrentXP/$hero->LevelUpXP*100}%">
    <span>{$hero->CurrentXP}XP/{$hero->LevelUpXP}XP{if $hero->CurrentXP >= $hero->LevelUpXP} <a href="viewHero.php?action=levelUp&ID={$hero->ID}">Try Level up</a>{/if}</span>
  </div>
</div><br />
Strength: {$hero->Str}{if isset($StrIncrease)} <span class="glyphicon glyphicon-arrow-up" style="color: limegreen;"></span> Strength increased when levelling up!{/if}<br />
Dexterity: {$hero->Dex}{if isset($DexIncrease)} <span class="glyphicon glyphicon-arrow-up" style="color: limegreen;"></span> Dexterity increased when levelling up!{/if}<br />
Constitution: {$hero->Con}{if isset($ConIncrease)} <span class="glyphicon glyphicon-arrow-up" style="color: limegreen;"></span> Constitution increased when levelling up!{/if}<br />
Intelligence: {$hero->Intel}{if isset($IntelIncrease)} <span class="glyphicon glyphicon-arrow-up" style="color: limegreen;"></span> Intelligence increased when levelling up!{/if}<br />
Wisdom: {$hero->Wis}{if isset($WisIncrease)} <span class="glyphicon glyphicon-arrow-up" style="color: limegreen;"></span> Wisdom increased when levelling up!{/if}<br />
Charisma: {$hero->Cha}{if isset($ChaIncrease)} <span class="glyphicon glyphicon-arrow-up" style="color: limegreen;"></span> Charisma increased when levelling up!{/if}<br /><br />

<div class="row">
	<div class="col-sm-4" >
		<div class="panel panel-default">
			<div class="panel-heading">
				<div id="weaponNameDiv"><b>{$hero->Weapon->Name}</b> <img src="images/icons/pencil_16.png" onclick='document.getElementById("weaponNameDiv").style.display = "none"; document.getElementById("weaponEditNameForm").style.display = "block";' /></div>
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
				Uses: {$hero->Weapon->DamageAttribute} (+{$hero->calculateAttributeBonus($hero->Weapon->DamageAttribute)})<br />
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