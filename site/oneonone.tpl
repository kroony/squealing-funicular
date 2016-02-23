<div class="container-fluid">
<div style="display: inline-block; margin: auto;">
	{$log->show()}

	{if $hero1->CurrentHP lt (0 - $hero1->Con)}
		{$hero1_name} has <b>died</b> in battle<br /><br />
		<b>{$hero2_name} is victorious!</b><br />
	{else if $hero1->CurrentHP lt 0}
		{$hero1_name} has been knocked out in battle<br /><br />
		<b>{$hero2_name} is victorious!</b><br />
	{/if}

	{if $hero2->CurrentHP lt (0 - $hero2->Con)}
		{$hero2_name} has died in battle<br /><br />
		<b>{$hero1_name}  is victorious!</b><br />
	{else if $hero2->CurrentHP lt 0}
		{$hero2_name} has been knocked out in battle<br /><br />
		<b>{$hero1_name} is victorious!</b><br />
	{/if}
	
	{if isset($WeaponLoot)}
		You manage to loot {$WeaponLoot->Name} from {$hero2_name}<br />
	{/if}
	{if isset($GoldLoot)}
		Townsfolk reward you with {$GoldLoot}gp for stopping {$hero2_name} for another day.<br />
	{/if}
	{if isset($WeaponLost)}
		{$hero2_name} looted {$WeaponLost->Name} from {$hero1_name}<br />
	{/if}
	<br />
	{$weaponLootRoll}
	
	<a href="home.php">Return</a>
</div>
</div>
</body>
