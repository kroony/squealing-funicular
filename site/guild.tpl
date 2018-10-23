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
<a href="addNew.php?level=1" class="btn btn-success {if !isset($canAffordHero)}disabled{/if}" data-toggle="tooltip" title="Hire a new hero for {$newHeroCost}gp"><span class="glyphicon glyphicon-eye-open"></span> Hire Hero {$newHeroCost}gp</a><br />
{if $currentUID == '146'}<a href="addNewMonster.php?level=5">Level 5</a>, <a href="addNewMonster.php?level=10">Level 10</a>, <a href="addNewMonster.php?level=15">Level 15</a>, <a href="addNewMonster.php?level=20">Level 20</a>{/if}
<table class='table table-hover'>
	<thead>
		<tr>
			<th>Name</th>
			<th>Type</th>
			<th>HP</th>
			<th>Level</th>
			<th>XP</th>
			<th>Weapon</th>
			<th>Fight</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$userHeros item=Hero}
		<tr>
			<td><a href='viewHero.php?ID={$Hero->ID}'>{str_replace("'", "", $Hero->Name)}</a></td>
			<td><span data-toggle="tooltip" title="This is {str_replace("'", "", $Hero->Name)}'s Race ({$Hero->Race->Name}) and Class ({$Hero->HeroClass->Name})">{$Hero->Race->Name} {$Hero->HeroClass->Name}</span></td>
			<td>
				<div class="progress">
					<div class="progress-bar {if $Hero->CurrentHP == $Hero->MaxHP} progress-bar-success {elseif $Hero->CurrentHP < $Hero->Con} progress-bar-danger {elseif $Hero->CurrentHP < $Hero->MaxHP} progress-bar-warning {/if}" 
					role="progressbar" aria-valuenow="{$Hero->CurrentHP}" aria-valuemin="0" aria-valuemax="{$Hero->MaxHP}" style="width:{$Hero->CurrentHP/$Hero->MaxHP*100}%" id="healthBar-{$Hero->ID}">
						<span id='currentHPSpan-{$Hero->ID}'>{$Hero->CurrentHP}HP/{$Hero->MaxHP}HP</span>
					</div>
					{if $Hero->CurrentHP < $Hero->MaxHP}<script>updateHealthBar({$Hero->ID}, {$Hero->MaxHP});</script>{/if}
				</div>
			</td>
			<td>{$Hero->Level}</td>
			<td>
				<div class="progress">
					<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{$Hero->CurrentXP}" aria-valuemin="0" aria-valuemax="{$Hero->LevelUpXP}" style="width:{$Hero->CurrentXP / $Hero->LevelUpXP * 100}%">
						<span{if $Hero->canLevelUp()} style="font-weight: bold;"{/if}>{number_format($Hero->CurrentXP)}XP/{number_format($Hero->LevelUpXP)}XP</span>
					</div>
				</div>
			</td>
			<td><a href="viewWeapon.php?ID={$Hero->Weapon->ID}" >{$Hero->Weapon->Name}</a> {$Hero->Weapon->DamageQuantity}d{$Hero->Weapon->DamageDie}{if $Hero->Weapon->DamageOffset < 0}{$Hero->Weapon->DamageOffset}{elseif $Hero->Weapon->DamageOffset > 0}+{$Hero->Weapon->DamageOffset}{/if} ({$Hero->Weapon->CritChance}%)
			{if $Hero->OwnerID == 146}<a href="generateWeapon.php?ID={$Hero->ID}"> - Generate New</a>{/if}</td>
			<td>
				{if $Hero->Status == "" || $Hero->Status == null || ($Hero->Status == "Fight Cooldown" && $Hero->StatusETA == "None") || ($Hero->Status == "Fight Cooldown A" && $Hero->StatusETA == "None")}
					{if $Hero->CurrentHP > 0}<a href='oneononechoose.php?ID={$Hero->ID}'>Fight!</a>
					{else}
            {if $Hero->isAlive() == false} <a href='delete.php?ID={$Hero->ID}'>Remove</a>{elseif $Hero->CurrentHP <= 0} <a href='revive.php?ID={$Hero->ID}'>Revive</a>{/if}
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
				</td>
		</tr>
		{/foreach}
	</tbody>
</table>

{foreach from=$userHeros item=Hero}
  <div class="col-md-3 col-sm-6">
    {assign var="hero" value=$Hero}
    {include file='displayHeroLocation.tpl'}
    <div class="location"><i class="glyphicon glyphicon-map-marker"></i> Guild Hall</div>
  </div>
{/foreach}


</div>
