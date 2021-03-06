<div class="container-fluid">
<p>Total: {$totalHeros}</p>
<table class='table table-hover'>
	<thead>
		<tr>
			<th>User</th>
			<th>Name</th>
			<th>Type</th>
			<th>HP</th>
			<th>Level</th>
			<th>XP</th>
			<th>Str</th>
			<th>Dex</th>
			<th>Con</th>
			<th>Int</th>
			<th>Wis</th>
			<th>Cha</th>
			<th>Fte</th>
			<th>Weapon</th>
			<th>Age</th>
			<th>Location</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$Heros item=Hero}
		<tr>
			<td>{if !empty($Hero->GetOwner())}{$Hero->GetOwner()->username}{else}Owner Unknown (ID: {$Hero->OwnerID}){/if}</td>
			<td><a href='viewHero.php?ID={$Hero->ID}'>{str_replace("'", "", $Hero->Name)}</a></td>
			<td>{$Hero->Race->Name} {$Hero->HeroClass->Name}</td>
			<td>
				<div class="progress">
					<div class="progress-bar {if $Hero->CurrentHP == $Hero->MaxHP} progress-bar-success {elseif $Hero->CurrentHP < $Hero->Con} progress-bar-danger {elseif $Hero->CurrentHP < $Hero->MaxHP} progress-bar-warning {/if}" 
					role="progressbar" aria-valuenow="{$Hero->CurrentHP}" aria-valuemin="0" aria-valuemax="{$Hero->MaxHP}" style="width:{$Hero->CurrentHP/$Hero->MaxHP*100}%">
						<span>{$Hero->CurrentHP}HP/{$Hero->MaxHP}HP{if $Hero->CurrentHP <= -$Hero->Con} <a href='delete.php?ID={$Hero->ID}'>Remove</a>{elseif $Hero->CurrentHP <= 0} <a href='revive.php?ID={$Hero->ID}'>Revive</a>{/if}</span>
					</div>
				</div>
			</td>
			<td>{$Hero->Level}</td>
			<td>
				<div class="progress">
					<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{$Hero->CurrentXP}"
					aria-valuemin="0" aria-valuemax="{$Hero->LevelUpXP}" style="width:{$Hero->CurrentXP / $Hero->LevelUpXP * 100}%">
						<span>{number_format($Hero->CurrentXP)}XP/{number_format($Hero->LevelUpXP)}XP{if $Hero->CurrentXP >= $Hero->LevelUpXP} <a href="viewHero.php?action=levelUp&ID={$Hero->ID}">Try Level up</a>{/if}</span>
					</div>
				</div>
			</td>
			<td>{$Hero->Str}</td>
			<td>{$Hero->Dex}</td>
			<td>{$Hero->Con}</td>
			<td>{$Hero->Intel}</td>
			<td>{$Hero->Wis}</td>
			<td>{$Hero->Cha}</td>
			<td>{$Hero->Fte}</td>
			<td>{$Hero->Weapon->Name} {$Hero->Weapon->DamageQuantity}d{$Hero->Weapon->DamageDie}
				{if $Hero->Weapon->DamageOffset < 0}{$Hero->Weapon->DamageOffset}{elseif $Hero->Weapon->DamageOffset > 0}+{$Hero->Weapon->DamageOffset}{/if}
				({$Hero->Weapon->CritChance}%)
			</td>
			<td>{$Hero->Age}</td>
			<td>{$Hero->Location->Name}</td>
			<td>{$Hero->Status} - {if $Hero->Status == "" || $Hero->Status == null}
            {if $Hero->CurrentHP > 0}No Status{/if}
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
