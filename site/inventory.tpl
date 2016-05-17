<div class="container-fluid">
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

<table class='table table-condensed table-hover'>
	<thead>
	  <tr>
		  <th>Name</th>
		  <th>Damage</th>
		  <th>Attribute</th>
		  <th>Crit</th>
		  <th>Hero</th>
		  <th>Scrap Value</th>
	  </tr>
	</thead>
	<tbody>
		{foreach from=$usersWeapons item=weapon}
		<tr>
			<td><a href="viewWeapon.php?ID={$weapon->ID}">{$weapon->Name}</a></td>
			<td>{$weapon->DamageQuantity}d{$weapon->DamageDie}{if $weapon->DamageOffset < 0}{$weapon->DamageOffset}{elseif $weapon->DamageOffset > 0}+{$weapon->DamageOffset}{/if}</td>
			<td>{$weapon->DamageAttribute}</td>
			<td>{$weapon->CritChance}%</td>
			<td>{if is_numeric($weapon->GetHeroIDFromWeapon())}
					<a href='viewHero.php?ID={$weapon->GetHeroIDFromWeapon()}'>{str_replace("'", "", $weapon->GetHeroNameFromWeapon())}</a>
				{elseif is_numeric($weapon->GetSaleIDFromWeapon())}
					Listed in Shop
				{else}
					{$weapon->GetHeroNameFromWeapon()}
				{/if}
			</td>
			<td>{if $weapon->isScrappable()}<a href="inventory.php?action=scrap&ID={$weapon->ID}">{$weapon->getScrapValue($userChaBonus)}gp - Scrap</a>{else}{$weapon->getScrapValue($userChaBonus)}gp{/if}</td>
		</tr>
		{/foreach}
	</tbody>
</table>
</div>