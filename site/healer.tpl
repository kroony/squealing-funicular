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
  <h1>Healer</h1>
  <div class="well">The town's local healer, heroes located at the healer will recover HP at twice the rate. Occasionally the Healer will ask for a donation, dismissing anyone that cant afford to pay.</div>
</div>

<div class="container-fluid">

{if $currentUID == '146'}<a href="addNewMonster.php?level=5">Level 5</a>, <a href="addNewMonster.php?level=10">Level 10</a>, <a href="addNewMonster.php?level=15">Level 15</a>, <a href="addNewMonster.php?level=20">Level 20</a>{/if}


{foreach from=$userHeros item=Hero}
  <div class="col-md-3 col-sm-6">
    {assign var="hero" value=$Hero}
    {include file='displayHeroLocation.tpl'}
    <div class="weapon">Weapon - <a href="viewWeapon.php?ID={$Hero->Weapon->ID}" >{$Hero->Weapon->Name}</a> {$Hero->Weapon->DamageQuantity}d{$Hero->Weapon->DamageDie}{if $Hero->Weapon->DamageOffset < 0}{$Hero->Weapon->DamageOffset}{elseif $Hero->Weapon->DamageOffset > 0}+{$Hero->Weapon->DamageOffset}{/if} ({$Hero->Weapon->CritChance}%)
    </div>
    <div class="location"><i class="glyphicon glyphicon-map-marker"></i> {$Hero->Location->Name} - 
      {if $Hero->Status == "" || $Hero->Status == null}
        {if $Hero->CurrentHP == $Hero->MaxHP}
          Healed!
        {else if $Hero->CurrentHP > 0}
          Resting
        {else}
          {if $Hero->isAlive() && $Hero->CurrentHP <= 0} <a href='revive.php?ID={$Hero->ID}'>Revive for {Hero->calculateReviveCost()}gp</a>{/if}
        {/if}
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
    </div>
    {include file='displayHeroTravel.tpl'}
  </div>
{/foreach}


</div>
