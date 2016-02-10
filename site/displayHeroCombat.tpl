<div class="container-fluid">
<div style="display:inline-block; vertical-align: top;{if $divFloatRight == "True"} float: right;{/if}">
<h2>{$displayHero->Name}</h2>
{$displayHero->Race->Name} {$displayHero->HeroClass->Name}<br />
<div class="progress">
  <div class="progress-bar {if $displayHero->CurrentHP == $displayHero->MaxHP} progress-bar-success {elseif $displayHero->CurrentHP < $displayHero->Con} progress-bar-danger {elseif $displayHero->CurrentHP < $displayHero->MaxHP} progress-bar-warning {/if}" 
  role="progressbar" aria-valuenow="{$displayHero->CurrentHP}" aria-valuemin="0" aria-valuemax="{$displayHero->MaxHP}" style="width:{$displayHero->CurrentHP/$displayHero->MaxHP*100}%">
	<span>{$displayHero->CurrentHP}HP/{$displayHero->MaxHP}HP</span>
  </div>
</div><br />
<div class="progress">
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{$displayHero->CurrentXP}"
  aria-valuemin="0" aria-valuemax="{$displayHero->LevelUpXP}" style="width:{$displayHero->CurrentXP/$displayHero->LevelUpXP*100}%">
    {if $divFloatRight != "True"}<span>{$displayHero->CurrentXP}XP/{$displayHero->LevelUpXP}XP</span>{/if}
  </div>
</div>
<br />
</div>
</div>