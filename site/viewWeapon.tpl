<div class="container-fluid">

<div class="panel panel-default">
	<div class="panel-heading">
		<div id="weaponNameDiv"><b>{$weapon->Name}</b> <img src="images/icons/pencil_16.png" onclick='document.getElementById("weaponNameDiv").style.display = "none"; document.getElementById("weaponEditNameForm").style.display = "block";' /></div>
		<form id="weaponEditNameForm" action="viewWeapon.php" style="display: none;">
			<input type="hidden" name="action" value="editWeaponName">
			<input type="hidden" name="ID" value="{$hero->ID}">
			<input type="hidden" name="WeaponID" value="{$weapon->ID}">
			<input type="text" name="weaponName" value="{$weapon->Name}">
			<input type="submit" value="Submit">
		</form>
	</div>
	<div class="panel-body">
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
		Damage: {$weapon->DamageQuantity}d{$weapon->DamageDie}{if $weapon->DamageOffset < 0}{$weapon->DamageOffset}{elseif $weapon->DamageOffset > 0}+{$weapon->DamageOffset}{/if} - Test<br />
		Damage Quantity {$weapon->DamageQuantity} +1 for {$weapon->calcDamageQuantityUpgradeCost()}gp<br />
		Damage Dice: {$weapon->DamageDie} +1 for {$weapon->calcDamageDieUpgradeCost()}gp<br />
		Damage Offset: {$weapon->DamageOffset} +1 for {$weapon->calcDamageOffsetUpgradeCost()}gp<br />
		Critical Chance: {$weapon->CritChance}% +1 for {$weapon->calcCritChanceUpgradeCost()}gp<br />
		Uses: {$weapon->DamageAttribute}<br />
	</div>
</div>



</div>