<div class="container-fluid">
<table class='table table-condensed table-hover'>
	<thead>
		<tr>
      <th>migration_name</th>
			<th>time</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$migrations item=migration}
		<tr>
      <td>{$migration->migration_name}</td>
			<td>{$migration->time}</td>
		</tr>
		{/foreach}
	</tbody>
</table>

</div>


