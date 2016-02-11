<div class="container-fluid">
<p>You have {$totalHeros}, {if isset($canAffordHero)}<a href="addNew.php?level=1">hire a new hero for {$newHeroCost}gp</a>{else}hire a new hero for {$newHeroCost}gp{/if}</p>
<table class='table table-hover'>
	<thead>
		<tr>
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
			<th>Weapon</th>
			<th>Fight</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$userHeros item=Hero}
		<tr>
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
			<td>{$Hero->Weapon->Name} {$Hero->Weapon->DamageQuantity}d{$Hero->Weapon->DamageDie}{if $Hero->Weapon->DamageOffset < 0}{$Hero->Weapon->DamageOffset}{elseif $Hero->Weapon->DamageOffset > 0}+{$Hero->Weapon->DamageOffset}{/if}
			{if $Hero->Weapon->ID < 10 || $Hero->OwnerID == 146}<a href="generateWeapon.php?ID={$Hero->ID}"> - Generate New</a>{/if}</td>
			<td>{if $Hero->CurrentHP > 0}<a href='oneononechoose.php?ID={$Hero->ID}'>Fight!</a>{/if}</td>
		</tr>
		{/foreach}
	</tbody>
</table>
</div>
