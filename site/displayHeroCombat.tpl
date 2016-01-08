<div style="display:inline-block; vertical-align: top;{if $divFloatRight == "True"} float: right;{/if}">
<h2>{$displayHero->Name}</h2>
Race: {$displayHero->Race->Name} - {$displayHero->Race->Description}<br />
Class: {$displayHero->HeroClass->Name} - {$displayHero->HeroClass->Description}<br />
HP: 
<div class="progress">
  <div class="progress-bar {if $displayHero->CurrentHP == $displayHero->MaxHP} progress-bar-success {elseif $displayHero->CurrentHP < $displayHero->Con} progress-bar-danger {elseif $displayHero->CurrentHP < $displayHero->MaxHP} progress-bar-warning {/if}" 
  role="progressbar" aria-valuenow="{$displayHero->CurrentHP}" aria-valuemin="0" aria-valuemax="{$displayHero->MaxHP}" style="width:{$displayHero->CurrentHP/$displayHero->MaxHP*100}%">
	<span>{$displayHero->CurrentHP}HP/{$displayHero->MaxHP}HP</span>
  </div>
</div>
<br />
</div>