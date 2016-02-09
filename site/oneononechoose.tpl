<div class="container-fluid">
<strong>{$hero->Name} (level {$hero->Level}) would like to fight:</strong><br /><br />

<table class='table table-condensed table-hover'>
<thead>
	<tr>
		<th>Opponent Name</th>
		<th>Level</th>
		<th>Type</th>
		<th>Owner</th>
	</tr>
</thead>
<tbody>
{foreach item=ag from=$against}
	<tr>
		<td><a href="oneonone.php?ID1={$hero->ID}&ID2={$ag->ID}">{$ag->Name}</a></td>
		<td>Level {if $ag->Level < 0}Unknown{else}{$ag->Level}{/if}</td>
		<td>{if $ag->Level < 0}Undead {/if}{$ag->Race->Name} {$ag->HeroClass->Name}</td>
		<td>{if !empty($ag->GetOwner())}{$ag->GetOwner()->username}{else}Owner Unknown (ID: {$ag->OwnerID}){/if}</td>
	</tr>
{/foreach}
</tbody>
</table>
</div>