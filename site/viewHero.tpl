<h1>{$hero->Name}</h1>
{include file='kobold.html'}
<br />
Level: {$hero->Level}<br />
Race: {$hero->Race->Name} - {$hero->Race->Description}<br />
Class: {$hero->HeroClass->Name} - {$hero->HeroClass->Description}<br />
HP: 
<div class="progress" style="display: inline-flex;width: 300px; position: relative;">
  <div class="progress-bar {if $hero->CurrentHP < $hero->Con} progress-bar-danger {elseif $hero->CurrentHP < $hero->MaxHP/2} progress-bar-warning {else} progress-bar-success {/if}" role="progressbar" 
  aria-valuenow="{$hero->CurrentHP}" aria-valuemin="0" aria-valuemax="{$hero->MaxHP}" style="width:{$hero->CurrentHP/$hero->MaxHP*100}%">
	<span>{$hero->CurrentHP}HP/{$hero->MaxHP}HP</span>
  </div>
</div><br />

XP: 
<div class="progress" style="display: inline-flex;width: 300px; position: relative;">
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






<div class="progress">
  <div class="progress-bar " role="progressbar" aria-valuenow="60"
  aria-valuemin="0" aria-valuemax="100" style="width:60%">
    60% Complete (warning)
  </div>
</div>

<div class="progress">
  <div class="progress-bar " role="progressbar" aria-valuenow="70"
  aria-valuemin="0" aria-valuemax="100" style="width:70%">
    70% Complete (danger)
  </div>
</div>

<a href="home.php">Return</a>