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
		{foreach from=$userParties item=Party}
		<tr>
			<td>{$Party->Name}</td>
			<td>{$Party->Status}</td>
			<td>{$Party->Cooldown}</td>
		</tr>
		{/foreach}
	</tbody>
</table>

</div>
