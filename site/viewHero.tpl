<h1>{$hero->Name}</h1>
{include file='kobold.html'}
<p>
	Level: {$hero->Level}<br />
	Race: {$hero->Race->Name} - {$hero->Race->Description}<br />
	Class: {$hero->HeroClass->Name} - {$hero->HeroClass->Description}<br />
	HP: <progress max="{$hero->MaxHP}" value="{$hero->CurrentHP}" style="-webkit-appearance: none; width: 250px;"></progress><i>bootstrap css has cooler bars</i><br />
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
<a href="home.php">Return</a>
