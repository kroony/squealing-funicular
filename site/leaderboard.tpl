<div class="container-fluid">
<h3>Top 10 by XP</h3>
<table class='table table-condensed table-hover'>
	<thead>
		<tr>
			<th>Rank</th>
			<th>Name</th>
			<th>Race</th>
			<th>Class</th>
			<th>Level</th>
			<th>XP</th>
			<th>User</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$XPHeroes key=rank item=Hero}
		<tr>
			<td>{$rank + 1}</td>
			<td>{str_replace("'", "", $Hero->Name)}</td>
			<td>{$Hero->Race->Name}</td>
			<td>{$Hero->HeroClass->Name}</td>
			<td>{$Hero->Level}</td>
			<td>
				<div class="progress">
					<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{$Hero->CurrentXP}"
					aria-valuemin="0" aria-valuemax="{$Hero->LevelUpXP}" style="width:{$Hero->CurrentXP / $Hero->LevelUpXP * 100}%">
						<span>{$Hero->CurrentXP}XP</span>
					</div>
				</div>
			</td>
			<td>{if !empty($Hero->GetOwner())}{$Hero->GetOwner()->username}{else}Owner Unknown (ID: {$Hero->OwnerID}){/if}</td>
		</tr>
		{/foreach}
	</tbody>
</table>
</div>
