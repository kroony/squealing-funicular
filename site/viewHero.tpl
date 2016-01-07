<h1>{$hero->Name}</h1>
{include file='kobold.html'}
<p>
	Level: {$hero->Level}<br />
	Race: {$hero->Race->Name} - {$hero->Race->Description}<br />
	Class: {$hero->HeroClass->Name} - {$hero->HeroClass->Description}<br />
	HP: 
	<div class="progress">
	  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
	  aria-valuemin="0" aria-valuemax="100" style="width:40%">
		{$hero->CurrentHP}HP/{$hero->MaxHP}HP
	  </div>
	</div><br />
	
	
	XP: <progress max="{$hero->LevelUpXP}" value="{$hero->CurrentXP}" style="width: 250px;"></progress><br />
	Strength: {$hero->Str}<br />
	Dexterity: {$hero->Dex}<br />
	Constitution: {$hero->Con}<br />
	Intellegence: {$hero->Intel}<br />
	Wisdom: {$hero->Wis}<br />
	Charasma: {$hero->Cha}<br />
</p>
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
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50"
  aria-valuemin="0" aria-valuemax="100" style="width:50%">
    50% Complete (info)
  </div>
</div>

<div class="progress">
  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60"
  aria-valuemin="0" aria-valuemax="100" style="width:60%">
    60% Complete (warning)
  </div>
</div>

<div class="progress">
  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70"
  aria-valuemin="0" aria-valuemax="100" style="width:70%">
    70% Complete (danger)
  </div>
</div>

<a href="home.php">Return</a>
