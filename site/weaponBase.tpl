<div class="container-fluid">
<table class='table table-condensed table-hover'>
	<thead>
		<tr>
			<th>name</th>
      <th>damagedie</th>
      <th>damagequantity</th>
      <th>minoffset</th>
      <th>maxoffset</th>
      <th>mincrit</th>
      <th>maxcrit</th>
      <th>damageattribute</th>
      <th>negativenameadjective</th>
      <th>positivenameadjective</th>
      <th>startingweapon</th>
      <th>npcweapon</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$weaponBases item=weaponBase}
		<tr>
			<td>{$weaponBase->name}</td>
      <td>{$weaponBase->damagedie}</td>
      <td>{$weaponBase->damagequantity}</td>
      <td>{$weaponBase->minoffset}</td>
      <td>{$weaponBase->maxoffset}</td>
      <td>{$weaponBase->mincrit}</td>
      <td>{$weaponBase->maxcrit}</td>
      <td>{$weaponBase->damageattribute}</td>
      <td>{$weaponBase->negativenameadjective}</td>
      <td>{$weaponBase->positivenameadjective}</td>
      <td>{$weaponBase->startingweapon}</td>
      <td>{$weaponBase->npcweapon}</td>
		</tr>
		{/foreach}
	</tbody>
</table>

</div>


