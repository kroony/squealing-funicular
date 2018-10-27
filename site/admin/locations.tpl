<div class="container-fluid">
<table class='table table-condensed table-hover'>
	<thead>
		<tr>
      <th>ID</th>
			<th>Name</th>
      <th>Explore</th>
      <th>MinLvl</th>
      <th>MaxLvl</th>
      <th>RewardType</th>
      <th>RewardChance</th>
      <th>NPCFightChance</th>
      <th>NPCList</th>
      <th>Distance</th>
      <th>Cost</th>
      <th>CostChance</th>
      <th>Hidden</th>
      <th>URL</th>
      <th>PageName</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$allLocations item=Location}
		<tr>
      <td>{$Location->ID}</td>
			<td>{$Location->Name}</td>
      <td>{$Location->RequiredExploration}</td>
      <td>{$Location->MinLevel}</td>
      <td>{$Location->MaxLevel}</td>
      <td>{$Location->RewardType}</td>
      <td>{$Location->RewardChance}</td>
      <td>{$Location->NPCFightChance}</td>
      <td>{$Location->NPCList}</td>
      <td>{$Location->Distance}</td>
      <td>{$Location->Cost}</td>
      <td>{$Location->CostChance}</td>
      <td>{$Location->Hidden}</td>
      <td>{$Location->URL}</td>
      <td>{$Location->PageName}</td>
		</tr>
		{/foreach}
	</tbody>
</table>

</div>


