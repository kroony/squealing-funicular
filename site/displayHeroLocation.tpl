<div style="display:inline-block; vertical-align: top;">
	<h2>{$hero->Name}</h2>
	{include file='portraits/kobold.html'}
	<br />
	{$hero->Race->Name} {$hero->HeroClass->Name} - Level {$hero->Level}<br />
	<div class="progress">
		<div class="progress-bar {if $hero->CurrentHP == $hero->MaxHP} progress-bar-success {elseif $hero->CurrentHP < $hero->Con} progress-bar-danger {elseif $hero->CurrentHP < $hero->MaxHP} progress-bar-warning {/if}" 
    role="progressbar" aria-valuenow="{$hero->CurrentHP}" aria-valuemin="0" aria-valuemax="{$hero->MaxHP}" style="width:{$hero->CurrentHP/$hero->MaxHP*100}%" id="healthBar-{$hero->ID}">
      <span id='currentHPSpan-{$hero->ID}'>{$hero->CurrentHP}HP/{$hero->MaxHP}HP</span>
    </div>
    {if $hero->CurrentHP < $hero->MaxHP}<script>updateHealthBar({$hero->ID}, {$hero->MaxHP});</script>{/if}
	</div>
	<br />
	<div class="progress">
		<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{$hero->CurrentXP}" aria-valuemin="0" aria-valuemax="{$hero->LevelUpXP}" style="width:{$hero->CurrentXP / $hero->LevelUpXP * 100}%">
      <span{if $hero->canLevelUp()} style="font-weight: bold;"{/if}>{number_format($hero->CurrentXP)}XP/{number_format($hero->LevelUpXP)}XP</span>
    </div>
	</div>
</div>