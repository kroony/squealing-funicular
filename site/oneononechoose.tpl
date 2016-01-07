{$hero->Name} (level {$hero->Level}) would like to fight:<br />

<table class='table table-condensed table-hover'>
{foreach item=ag from=$against}
        <!--$owner = mysql_get_rows("SELECT * FROM `User` WHERE ID = " . $ag->OwnerID);
		To get the username add this as property to the $ag object-->
        <tr>
          <td><a href="oneonone.php?ID1={$hero->ID}&ID2={$ag->ID}">{$ag->Name}</a></td>
          <td>Level {if $ag->Level < 0}Unknown{else}{$ag->Level}{/if}</td>
          <td>{if $ag->Level < 0}Undead {/if}{$ag->Race->Name}</td>
          <td>{$ag->HeroClass->Name}</td>
          <td>Owner: {if !empty($ag->GetOwner())}{$ag->GetOwner()->username}{else}Owner Unknown (ID: {$ag->OwnerID}){/if}</td>
        </tr>
{/foreach}
</table>

<a href="home.php">Return</a>
