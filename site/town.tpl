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
  <h1>Town</h1>
  <div class="well">All your heroes exploring town help to finding new locations, but while in town they run the risk of being attacked.</div>
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
          <a class="btn btn-danger" href='oneononechoose.php?ID={$Hero->ID}'><i class="fas fa-fist-raised"></i> Fight</a>
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
