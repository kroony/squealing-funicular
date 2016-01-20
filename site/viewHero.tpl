<div id="heroName"><h1>{$hero->Name} <img src="images/icons/pencil_24.png" onclick='document.getElementById("heroName").style.display = "none"; document.getElementById("heroEditName").style.display = "block";'</h1></div>
<form id="heroEditName" action="editName.php" style="display: none;">
<input type="hidden" name="heroID" value="{$hero->ID}">
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
    <span>{$hero->CurrentXP}XP/{$hero->LevelUpXP}XP</span>
  </div>
</div><br />
Strength: {$hero->Str}<br />
Dexterity: {$hero->Dex}<br />
Constitution: {$hero->Con}<br />
Intelligence: {$hero->Intel}<br />
Wisdom: {$hero->Wis}<br />
Charisma: {$hero->Cha}<br />

<p>
	<h2>Weapon</h2>
	<i>@TODO: image, ability to unequip/equip different weapons</i><br />
	{$hero->Weapon->Name} 
	Damage: {$hero->Weapon->DamageQuantity}d{$hero->Weapon->DamageDie}+{$hero->Weapon->DamageOffset}<br />
	Uses: {$hero->Weapon->DamageAttribute} (+{$hero->calculateAttributeBonus($hero->Weapon->DamageAttribute)})<br />
	Critical Strike Chance: 
		{if $hero->Cha > 10}
			{$hero->Weapon->CritChance + $hero->calculateAttributeBonus($hero->Cha)}%
		{else}
			{$hero->Weapon->CritChance}%
		{/if}
	<br />
</p>
<p><h2>Armor</h2></p>
<p><h2>Item</h2></p>
<br />

<a href="home.php">Return</a>
