<div class="container-fluid">
<table class='table table-condensed table-hover'>
	<thead>
		<tr>
			<th>Name</th>
			<th>Status</th>
			<th>Cooldown</th>
		</tr>
	</thead>
	<tbody>
		{* foreach from=$userParties item=Party *}
		<tr>
			<td>{* $Party->Name *}</td>
			<td>{* $Party->Status *}</td>
			<td>{* $Party->Cooldown *}</td>
		</tr>
		{* /foreach *}
	</tbody>
</table>

<p>
Comming soon</p>

<p>
Select upto 6 heroes to join a party.<br />
A party can attempt missions with given goals and rewards. The party can adventure for loot and recruitment. The party could also try marauding other parties for their hard earned loot. <br />
This should be the primary function of the game, and thus will take some time to implement. 
</p>

</div>
