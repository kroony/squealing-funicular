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
  <h1>Guild Hall</h1>
  <div class="well">All your heroes are safe in the guild hall, this is a good place to be while resting up for more adventuring.</div>
</div>

<div class="container-fluid">

{if $currentUID == '146'}<a href="addNewMonster.php?level=5">Level 5</a>, <a href="addNewMonster.php?level=10">Level 10</a>, <a href="addNewMonster.php?level=15">Level 15</a>, <a href="addNewMonster.php?level=20">Level 20</a>{/if}


{foreach from=$userHeros item=Hero}
  <div class="col-md-3 col-sm-6">
    {assign var="hero" value=$Hero}
    {include file='displayHeroLocation.tpl'}
    <div class="weapon">Weapon - <a href="viewWeapon.php?ID={$Hero->Weapon->ID}" >{$Hero->Weapon->Name}</a> {$Hero->Weapon->DamageQuantity}d{$Hero->Weapon->DamageDie}{if $Hero->Weapon->DamageOffset < 0}{$Hero->Weapon->DamageOffset}{elseif $Hero->Weapon->DamageOffset > 0}+{$Hero->Weapon->DamageOffset}{/if} ({$Hero->Weapon->CritChance}%)
			{if $Hero->OwnerID == 146}<a href="generateWeapon.php?ID={$Hero->ID}"> - Generate New</a>{/if}
    </div>
    <div class="location"> 
      {if $Hero->Status == "" || $Hero->Status == null}
        {if $Hero->CurrentHP > 0}
          {if $Hero->CurrentXP >= $Hero->LevelUpXP}<a class="btn btn-info" href="viewHero.php?action=levelUp&ID={$Hero->ID}"><i class="fas fa-user-plus"></i> Try Level up</a>{/if}
        {else}
          {if $Hero->isAlive() == false} <a class="btn btn-hp" href='delete.php?ID={$Hero->ID}'><i class="fas fa-user-times"></i> Remove</a>{/if}
        {/if}
      {else}
        {if $Hero->StatusETA != 'None'}
          <button type="button" class="btn">{$Hero->Status}, <span id="{$Hero->ID}StatusCountdown"></span></button>
          <script type="text/javascript">
            countdown( "{$Hero->ID}StatusCountdown", {$Hero->getStatusCountdownJSArgs()} );
          </script>
        {else}
          {if $hero->Status == "Level Up" && $hero->StatusETA == 'None'}
            <a class="btn btn-info" href="viewHero.php?action=FinishlevelUp&ID={$hero->ID}"><i class="fas fa-user-plus"></i> Complete Level Up!</a>
          {else}
            <button type="button" class="btn">{$Hero->Status}</button>
          {/if}
        {/if}
      {/if}
    </div>
    {include file='displayHeroTravel.tpl'}
  </div>
{/foreach}







  <div class="col-md-3 col-sm-6">
    <div style="display:inline-block; vertical-align: top;">
      <h2>Recruitment</h2>
      <a href="addNew.php?level=1" class="btn btn-success {if !isset($canAffordHero)}disabled{/if}" data-toggle="tooltip" title="Hire a new hero for {$newHeroCost}gp" style="width: 300px; height: 250px; display: table-cell;">
        <span class="glyphicon glyphicon-eye-open"></span> Hire Hero {$newHeroCost}gp
      </a>
      <br />
      Random Race and Class - Level 1<br />
      <div class="progress">
        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="1" style="width:100%">
          <span>?HP/?HP</span>
        </div>
      </div>
      <br />
      <div class="progress">
        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="1" style="width:100%">
          <span>0XP/?XP</span>
        </div>
      </div>
    </div>
    <div class="weapon">Weapon - ???</div>
    <div class="location"><i class="glyphicon glyphicon-map-marker"></i> Hire New Hero</div>
  </div>
</div>
