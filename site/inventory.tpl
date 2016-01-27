<table class='table table-condensed table-hover'>
	<thead>
	  <tr>
		  <td>Name</td>
		  <td>Damage</td>
		  <td>Attribute</td>
		  <td>Crit</td>
		  <td>Hero</td>
		  <td>Hero Owner</td>
		  <td>Scrap Value</td>
	  </tr>
	</thead>
	<tbody>
		{foreach from=$usersWeapons item=weapon}
		<tr>
			<td>{$weapon->Name}</td>
			<td>{$weapon->DamageQuantity}d{$weapon->DamageDie}{if $weapon->DamageOffset < 0}{$weapon->DamageOffset}{elseif $weapon->DamageOffset > 0}+{$weapon->DamageOffset}{/if}</td>
			<td>{$weapon->DamageAttribute}</td>
			<td>{$weapon->CritChance}%</td>
			<td>{$weapon->GetHeroNameFromWeapon()}</td>
			<td>{if is_numeric($weapon->GetHeroIDFromWeapon())}{$tmpHero->loadHero($weapon->GetHeroIDFromWeapon())->GetOwner()->username}{/if}</td>
			<td>{if $weapon->GetHeroNameFromWeapon() == "Not Equipped"}<a href="inventory.php?action=scrap&ID={$weapon->ID}">{$weapon->getScrapValue()} - Scrap</a>{else}{$weapon->getScrapValue()}{/if}</td>
		</tr>
		{/foreach}
	</tbody>
</table>