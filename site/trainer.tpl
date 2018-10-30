<script>
function updateHealthBar(heroID, maxHP)
{
  //xml get hp
  var getHeroHealthXML = new XMLHttpRequest();
  getHeroHealthXML.open("POST", "xml/getHeroHealth.php", true);
  getHeroHealthXML.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  var params = "HeroID=" + heroID;
              
  getHeroHealthXML.send(params);
  getHeroHealthXML.onload = function() {
    if(getHeroHealthXML.responseText == "Error") {
      //display error
    }else{
      newHP = getHeroHealthXML.responseText;
      if(newHP < 1) { document.getElementById('healthBar-' + heroID).style.width = '0%'; }
      else { document.getElementById('healthBar-' + heroID).style.width = ((newHP / maxHP) * 100) + '%'; }
      document.getElementById('currentHPSpan-' + heroID).innerHTML = newHP+'HP/'+maxHP+'HP';
      if(newHP < maxHP) { setTimeout(function() { updateHealthBar(heroID, maxHP); }, 60000); }
    }
  }
}
</script>

<div class="container-fluid">
  <h1>Training Hall</h1>
  {if $currentTrainerLevel == 0}
    <div class="well">The Training Hall houses house 6 trainers, each one able to increase a heroes attributes. The trainers have all been kidnapped by agents of the evil Black Ninja. Send heroes in the Training Hall to recover the trainers.</div>
   {else if $currentTrainerLevel == 1}
    <div class="well">You have rescued Strength, quest for the rest.</div>
   {else if $currentTrainerLevel == 2}
    <div class="well">You have rescued Strength, and Intelligence. Quest for the rest.</div>
   {else if $currentTrainerLevel == 3}
    <div class="well">You have rescued Strength, Intelligence, and Dexterity. Quest for the rest.</div>
   {else if $currentTrainerLevel == 4}
    <div class="well">You have rescued Strength, Intelligence, Dexterity and Wisdom. Quest for the rest.</div>
   {else if $currentTrainerLevel == 5}
    <div class="well">You have rescued Strength, Intelligence, Dexterity, Wisdom and Constitution. Quest for the rest.</div>
   {else if $currentTrainerLevel == 6}
    <div class="well">You have rescued all the trainers.</div>
   {/if}
</div>

<div class="container-fluid">
{if $currentUID == '146'}<a href="addNewMonster.php?level=5">Level 5</a>, <a href="addNewMonster.php?level=10">Level 10</a>, <a href="addNewMonster.php?level=15">Level 15</a>, <a href="addNewMonster.php?level=20">Level 20</a>{/if}
<div class="col-md-2 col-sm-6">
Exploration required for next location:
</div>
<div class="col-md-10 col-sm-6">
  <div class="progress" style="width:100%;">
    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{$exploration}" aria-valuemin="0" aria-valuemax="{$nextExploration}" style="width:{$exploration / $nextExploration * 100}%">
      <span>{number_format($exploration)}/{number_format($nextExploration)}</span>
    </div>
  </div>
</div>

{foreach from=$userHeros item=Hero}
  <div class="col-md-3 col-sm-6">
    {assign var="hero" value=$Hero}
    {include file='displayHeroLocation.tpl'}
    <div class="weapon">Weapon - <a href="viewWeapon.php?ID={$Hero->Weapon->ID}" >{$Hero->Weapon->Name}</a> {$Hero->Weapon->DamageQuantity}d{$Hero->Weapon->DamageDie}{if $Hero->Weapon->DamageOffset < 0}{$Hero->Weapon->DamageOffset}{elseif $Hero->Weapon->DamageOffset > 0}+{$Hero->Weapon->DamageOffset}{/if} ({$Hero->Weapon->CritChance}%)
			{if $Hero->OwnerID == 146}<a href="generateWeapon.php?ID={$Hero->ID}"> - Generate New</a>{/if}
    </div>
    <div class="location">
      {if $Hero->Status == "" || $Hero->Status == null || ($Hero->Status == "Fight Cooldown" && $Hero->StatusETA == "None") || ($Hero->Status == "Fight Cooldown A" && $Hero->StatusETA == "None")}
        {if $Hero->CurrentHP > 0}
          {if $currentTrainerLevel != 0}
            {if $currentTrainerLevel < 2}//str
              {if $user->canAfford($hero->calculateAttributeUpgradeCost($hero->Str))}
								<a href="viewHero.php?action=Train&increase=Str&ID={$hero->ID}"><span class="glyphicon glyphicon-arrow-up" data-toggle="tooltip" title="Train Strength"></span></a>
							{/if} 
							Train for {number_format($hero->calculateAttributeUpgradeCost($hero->Str))}gp
            {/if}
            {if $currentTrainerLevel < 3}//intel
              {if $user->canAfford($hero->calculateAttributeUpgradeCost($hero->Intel))}
								<a href="viewHero.php?action=Train&increase=Intel&ID={$hero->ID}"><span class="glyphicon glyphicon-arrow-up" data-toggle="tooltip" title="Train Intelligence"></span></a>
							{/if} 
							Train for {number_format($hero->calculateAttributeUpgradeCost($hero->Intel))}gp
            {/if}
            {if $currentTrainerLevel < 4}//dex
              {if $user->canAfford($hero->calculateAttributeUpgradeCost($hero->Dex))}
								<a href="viewHero.php?action=Train&increase=Dex&ID={$hero->ID}"><span class="glyphicon glyphicon-arrow-up" data-toggle="tooltip" title="Train Dexterity"></span></a>
							{/if} 
							Train for {number_format($hero->calculateAttributeUpgradeCost($hero->Dex))}gp
            {/if}
            {if $currentTrainerLevel < 5}//wis
              {if $user->canAfford($hero->calculateAttributeUpgradeCost($hero->Wis))}
								<a href="viewHero.php?action=Train&increase=Wis&ID={$hero->ID}"><span class="glyphicon glyphicon-arrow-up" data-toggle="tooltip" title="Train Wisdom"></span></a>
              {/if} 
							Train for {number_format($hero->calculateAttributeUpgradeCost($hero->Wis))}gp
            {/if}
            {if $currentTrainerLevel < 6}//con
              {if $user->canAfford($hero->calculateAttributeUpgradeCost($hero->Con))}
								<a href="viewHero.php?action=Train&increase=Con&ID={$hero->ID}"><span class="glyphicon glyphicon-arrow-up" data-toggle="tooltip" title="Train Constitution"></span></a>
							{/if} 
							Train for {number_format($hero->calculateAttributeUpgradeCost($hero->Con))}gp
            {/if}
            {if $currentTrainerLevel < 7}//cha
              {if $user->canAfford($hero->calculateAttributeUpgradeCost($hero->Cha))}
								<a href="viewHero.php?action=Train&increase=Cha&ID={$hero->ID}"><span class="glyphicon glyphicon-arrow-up" data-toggle="tooltip" title="Train Charisma"></span></a>
							{/if} 
							Train for {number_format($hero->calculateAttributeUpgradeCost($hero->Cha))}gp
            {/if}
          {/if}
          {if $currentTrainerLevel < 6}
            <a class="btn btn-danger" href='#?ID={$Hero->ID}'><i class="fas fa-fist-raised"></i> Quest for Trainer</a>
          {/if}
        {/if}
      {else}
        {if $Hero->StatusETA != 'None'}
          <button type="button" class="btn">{$Hero->Status}, <span id="{$Hero->ID}StatusCountdown"></span></button>
          <script type="text/javascript">
            countdown( "{$Hero->ID}StatusCountdown", {$Hero->getStatusCountdownJSArgs()} );
          </script>
        {else}
          <button type="button" class="btn">{$Hero->Status}</button>
        {/if}
      {/if}
    </div>
    {include file='displayHeroTravel.tpl'}
  </div>
{/foreach}

</div>
