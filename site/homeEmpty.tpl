<div class="container-fluid">
	<div class="jumbotron">
		<p>You currently have no heroes in your employ.<br />
		Initially heroes will be happy to join you for free, but once you develop a name for yourself you will have to pay new heroes to join your service.<br />
		Start off by <a href="addNew.php?level=1&first">hiring your first hero</a> and looking at their Stats.</p> 
	</div>
</div>
	<thead>
		<tr>
			<th>Name</th>
			<th>Type</th>
			<th>HP</th>
			<th>Level</th>
			<th>XP</th>
			<!--<th>Str</th>
			<th>Dex</th>
			<th>Con</th>
			<th>Int</th>
			<th>Wis</th>
			<th>Cha</th>-->
			<th>Weapon</th>
			<th>Fight</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$userHeros item=Hero}
		<tr>
			<td><a href='viewHero.php?ID={$Hero->ID}'>{str_replace("'", "", $Hero->Name)}</a></td>
			<td><span data-toggle="tooltip" title="This is {str_replace("'", "", $Hero->Name)}'s Race ({$Hero->Race->Name}) and Class ({$Hero->HeroClass->Name})">{$Hero->Race->Name} {$Hero->HeroClass->Name}</span></td>
			<td>
				<div class="progress">
					<div class="progress-bar {if $Hero->CurrentHP == $Hero->MaxHP} progress-bar-success {elseif $Hero->CurrentHP < $Hero->Con} progress-bar-danger {elseif $Hero->CurrentHP < $Hero->MaxHP} progress-bar-warning {/if}" 
					role="progressbar" aria-valuenow="{$Hero->CurrentHP}" aria-valuemin="0" aria-valuemax="{$Hero->MaxHP}" style="width:{$Hero->CurrentHP/$Hero->MaxHP*100}%">
						<span>{$Hero->CurrentHP}HP/{$Hero->MaxHP}HP{if $Hero->isAlive() == false} <a href='delete.php?ID={$Hero->ID}'>Remove</a>{elseif $Hero->CurrentHP <= 0} <a href='revive.php?ID={$Hero->ID}'>Revive</a>{/if}</span>
					</div>
				</div>
			</td>
			<td>{$Hero->Level}</td>
			<td>
				<div class="progress">
					<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{$Hero->CurrentXP}"
					aria-valuemin="0" aria-valuemax="{$Hero->LevelUpXP}" style="width:{$Hero->CurrentXP / $Hero->LevelUpXP * 100}%">
						<span{if $Hero->canLevelUp()} style="font-weight: bold;"{/if}>{number_format($Hero->CurrentXP)}XP/{number_format($Hero->LevelUpXP)}XP</span>
					</div>
				</div>
			</td>
			<!--<td>{$Hero->Str}</td>
			<td>{$Hero->Dex}</td>
			<td>{$Hero->Con}</td>
			<td>{$Hero->Intel}</td>
			<td>{$Hero->Wis}</td>
			<td>{$Hero->Cha}</td>-->
			<td><a href="viewWeapon.php?ID={$Hero->Weapon->ID}" >{$Hero->Weapon->Name}</a> {$Hero->Weapon->DamageQuantity}d{$Hero->Weapon->DamageDie}{if $Hero->Weapon->DamageOffset < 0}{$Hero->Weapon->DamageOffset}{elseif $Hero->Weapon->DamageOffset > 0}+{$Hero->Weapon->DamageOffset}{/if}
			{if $Hero->OwnerID == 146}<a href="generateWeapon.php?ID={$Hero->ID}"> - Generate New</a>{/if}</td>
			<td>
				{if $Hero->Status == "" || $Hero->Status == null}
					{if $Hero->CurrentHP > 0}<a href='oneononechoose.php?ID={$Hero->ID}'>Fight!</a>{/if}
				{else}
					{if $Hero->StatusETA != 'None'}
						{$Hero->Status}, <span id="{$Hero->ID}StatusCountdown"></span>
						<script type="text/javascript">
							countdown( "{$Hero->ID}StatusCountdown", {$Hero->getStatusCountdownJSArgs()} );
						</script>
					{else}
						{$Hero->Status}
					{/if}
				{/if}
				</td>
		</tr>
		{/foreach}
	</tbody>
</table>
</div>
