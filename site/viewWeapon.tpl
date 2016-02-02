<div class="container-fluid">

<div class="panel panel-default">
	<div class="panel-heading">
		<div id="weaponNameDiv"><b>{$weapon->Name}</b> <img src="images/icons/pencil_16.png" onclick='document.getElementById("weaponNameDiv").style.display = "none"; document.getElementById("weaponEditNameForm").style.display = "block";' /></div>
		<form id="weaponEditNameForm" action="viewWeapon.php" style="display: none;">
			<input type="hidden" name="action" value="editWeaponName">
			<input type="hidden" name="ID" value="{$weapon->ID}">
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
		<table class='table table-condensed table-hover'>
			<tr>
				<td>Weapon Attribute</td>
				<td>Current Value</td>
				<td>Upgrade</td>
			</tr>
			<tr>
				<td>Damage Quantity</td><td>{$weapon->DamageQuantity}</td>
				{if $user->canAfford($weapon->calcDamageQuantityUpgradeCost())}
					<td><a href="viewWeapon.php?action=upgradeQuantity&ID={$weapon->ID}"><span class="glyphicon glyphicon-arrow-up"></span></a> {$weapon->calcDamageQuantityUpgradeCost()} gp</td>
				{else}
					<td>{$weapon->calcDamageQuantityUpgradeCost()} gp</td>
				{/if}
			</tr>
			<tr>
				<td>Damage Dice</td><td>{$weapon->DamageDie}</td>
				{if $user->canAfford($weapon->calcDamageDieUpgradeCost())}
					<td><a href="viewWeapon.php?action=upgradeDie&ID={$weapon->ID}"><span class="glyphicon glyphicon-arrow-up"></span></a> {$weapon->calcDamageDieUpgradeCost()} gp</td>
				{else}
					<td>{$weapon->calcDamageDieUpgradeCost()} gp</td>
				{/if}
			</tr>
			<tr>
				<td>Damage Offset</td><td>{$weapon->DamageOffset}</td>
				{if $user->canAfford($weapon->calcDamageOffsetUpgradeCost())}
					<td><a href="viewWeapon.php?action=upgradeOffset&ID={$weapon->ID}"><span class="glyphicon glyphicon-arrow-up"></span></a> {$weapon->calcDamageOffsetUpgradeCost()} gp</td>
				{else}
					<td>{$weapon->calcDamageOffsetUpgradeCost()} gp</td>
				{/if}
			</tr>
			<tr>
				<td>Critical Chance</td><td>{$weapon->CritChance}</td>
				{if $user->canAfford($weapon->calcCritChanceUpgradeCost())}
					<td><a href="viewWeapon.php?action=upgradeCrit&ID={$weapon->ID}"><span class="glyphicon glyphicon-arrow-up"></span></a> {$weapon->calcCritChanceUpgradeCost()} gp</td>
				{else}
					<td>{$weapon->calcCritChanceUpgradeCost()} gp</td>
				{/if}
			</tr>
		</table>
		Uses: {$weapon->DamageAttribute}<br />
	</div>
</div>



</div>