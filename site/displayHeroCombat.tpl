<h1>{$displayHero->Name}</h1>
Race: {$displayHero->Race->Name} - {$displayHero->Race->Description}<br />
Class: {$displayHero->HeroClass->Name} - {$displayHero->HeroClass->Description}<br />
HP: 
<div class="progress">
  <div class="progress-bar {if $displayHero->CurrentHP < $displayHero->Con} progress-bar-danger {elseif $displayHero->CurrentHP < $displayHero->MaxHP/2} progress-bar-warning {else} progress-bar-success {/if}" role="progressbar" 
  aria-valuenow="{$displayHero->CurrentHP}" aria-valuemin="0" aria-valuemax="{$displayHero->MaxHP}" style="width:{$displayHero->CurrentHP/$displayHero->MaxHP*100}%">
	<span>{$displayHero->CurrentHP}HP/{$displayHero->MaxHP}HP{if $displayHero->CurrentHP <= -$displayHero->Con} <a href='delete.php?ID={$displayHero->ID}'>Remove</a>{elseif $displayHero->CurrentHP <= 0} <a href='revive.php?ID={$displayHero->ID}'>Revive</a>{/if}</span>
  </div>
</div>