<div style="display:inline-block; vertical-align: top;">
	<h2>{$hero->Name}</h2>
	{include file='portraits/kobold.html'}
	<br />
	{$hero->Race->Name} {$hero->HeroClass->Name} - {if !empty($hero->GetOwner())}{$hero->GetOwner()->username}{else}Owner Unknown (ID: {$hero->OwnerID}){/if}<br />
	<div class="progress">
	<div class="progress-bar {if $hero->CurrentHP == $hero->MaxHP} progress-bar-success {elseif $hero->CurrentHP < $hero->Con} progress-bar-danger {elseif $hero->CurrentHP < $hero->MaxHP} progress-bar-warning {/if}" 
	role="progressbar" aria-valuenow="{$hero->CurrentHP}" aria-valuemin="0" aria-valuemax="{$hero->MaxHP}" style="width:{$hero->CurrentHP/$hero->MaxHP*100}%">
		<span>{$hero->CurrentHP}HP/{$hero->MaxHP}HP</span>
	</div>
</div>
<br />
<div class="progress">
	<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{$hero->CurrentXP}" aria-valuemin="0" aria-valuemax="{$hero->LevelUpXP}" style="width:{$hero->CurrentXP/$hero->LevelUpXP*100}%">
		{if $divFloatRight != "True"}<span>{$hero->CurrentXP}XP/{$hero->LevelUpXP}XP</span>{/if}
	</div>
</div>