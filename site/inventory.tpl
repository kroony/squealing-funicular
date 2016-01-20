<table class='table table-condensed table-hover'>
  <thead>
  <tr>
  <td>Name</td>
  <td>Damage</td>
  <td>Attribute</td>
  <td>Crit</td>
  </tr>
  </thead><tbody>
{foreach $usersWeapons as $weapon}
<tr>
<td>{$weapon->Name}</td>
<td>{$Weapon->DamageQuantity}d{$Weapon->DamageDie}+{$Weapon->DamageOffset}</td>
<td>{$weapon->DamageAttribute}</td>
<td>{$weapon->CritChance}%</td>
</tr>
{/foreach}
</tbody></table>