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
		<td><span data-toggle="tooltip" title="Make {$hero->Name} fight {$ag->Name}"><a href="oneonone.php?ID1={$hero->ID}&ID2={$ag->ID}">{$ag->Name}</a></td>
		<td>
			{if $ag->Level < 0}
				<span data-toggle="tooltip" title="The corpses of the undead are a far too wretched and twisted sight to behold. Identifying their Level by sight is almost impossible. Some clues can be gained by their obvious class at the time of death, but even then their true hidden strength is unknown.">Unknown</span>
			{else}
				Level 
				{if $hero->rollSeekLevel() > $ag->rollHideLevel()}
					{$ag->Level}
				{else}
					<span data-toggle="tooltip" title="Its not clear what level this potential enemy is, try training Intelligence to increase your chances of discerning enemy levels.">???</span>
				{/if}
			{/if}
		</td>
		<td>{if $ag->Level < 0}Undead {/if}{$ag->Race->Name} {$ag->HeroClass->Name}</td>
		<td>{if !empty($ag->GetOwner())}{$ag->GetOwner()->username}{else}Owner Unknown (ID: {$ag->OwnerID}){/if}</td>
	</tr>
{/foreach}
</tbody>
</table>
</div>