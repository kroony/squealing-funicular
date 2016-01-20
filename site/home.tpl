<table class='table table-condensed table-hover'>
	<thead>
		<tr>
			<td>Name</td>
			<td>Race</td>
			<td>Class</td>
			<td>HP</td>
			<td>Level</td>
			<td>XP</td>
			<td>Str</td>
			<td>Dex</td>
			<td>Con</td>
			<td>Int</td>
			<td>Wis</td>
			<td>Cha</td>
			<td>Weapon</td>
			<td>Fight</td>
		</tr>
	</thead>
	<tbody>
		{foreach from=$userHeros item=Hero}
		<tr>
			<td><a href='viewHero.php?ID={$Hero->ID}'>{str_replace("'", "", $Hero->Name)}</a></td>
			<td>{$Hero->Race->Name}</td>
			<td>{$Hero->HeroClass->Name}</td>
			<td>
				<div class="progress">
					<div class="progress-bar {if $displayHero->CurrentHP == $displayHero->MaxHP} progress-bar-success {elseif $displayHero->CurrentHP < $displayHero->Con} progress-bar-danger {elseif $displayHero->CurrentHP < $displayHero->MaxHP} progress-bar-warning {/if}" 
					role="progressbar" aria-valuenow="{$hero->CurrentHP}" aria-valuemin="0" aria-valuemax="{$hero->MaxHP}" style="width:{$hero->CurrentHP/$hero->MaxHP*100}%">
						<span>{$hero->CurrentHP}HP/{$hero->MaxHP}HP{if $hero->CurrentHP <= -$hero->Con} <a href='delete.php?ID={$hero->ID}'>Remove</a>{elseif $hero->CurrentHP <= 0} <a href='revive.php?ID={$hero->ID}'>Revive</a>{/if}</span>
					</div>
				</div>
			</td>
			<td>{$Hero->Level}</td>
			<td>
				<div class="progress">
					<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{$Hero->CurrentXP}"
					aria-valuemin="0" aria-valuemax="{$Hero->LevelUpXP}" style="width:{$Hero->CurrentXP / $Hero->LevelUpXP * 100}%">
						<span>{$Hero->CurrentXP}XP/{$Hero->LevelUpXP}XP{if $Hero->CurrentXP >= Hero->LevelUpXP} <a href="levelUp.php?ID='{$Hero->ID}">Try Level up</a>{/if}</span>
					</div>
				</div>
			</td>
			<td>{$Hero->Str}</td>
			<td>{$Hero->Dex}</td>
			<td>{$Hero->Con}</td>
			<td>{$Hero->Intel}</td>
			<td>{$Hero->Wis}</td>
			<td>{$Hero->Cha}</td>
			<td>{$Hero->Weapon->Name} {$weapon->DamageQuantity}d{$weapon->DamageDie}{if $weapon->DamageOffset < 0}{$weapon->DamageOffset}{elseif $weapon->DamageOffset > 0}+{$weapon->DamageOffset}{/if}{if $Hero->Weapon->ID < 10}<a href="generateWeapon.php?ID={$Hero->ID}"> - Generate New</a>{/if}</td>
			<td>{if $Hero->CurrentHP > 0}<a href='oneononechoose.php?ID={$Hero->ID}'>Fight!</a>{/if}</td>
		</tr>
		{/foreach}
	</tbody>
</table>

{if $totalHeros < 20}
<p>Generate Level: <a href="addNew.php?level=1">1</a></p>
{/if}
