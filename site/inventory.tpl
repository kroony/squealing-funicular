<table class='table table-condensed table-hover'>
	<thead>
	  <tr>
		  <td>Name</td>
		  <td>Damage</td>
		  <td>Attribute</td>
		  <td>Crit</td>
		  <td>Hero</td>
	  </tr>
	</thead>
	<tbody>
		{foreach from=$usersWeapons item=weapon}
		<tr>
			<td>{$weapon->Name}</td>
			<td>{$weapon->DamageQuantity}d{$weapon->DamageDie}+{$weapon->DamageOffset}</td>
			<td>{$weapon->DamageAttribute}</td>
			<td>{$weapon->CritChance}%</td>
			<td>{$weapon->GetHeroNameFromWeapon}%</td>
		</tr>
		{/foreach}
	</tbody>
</table>