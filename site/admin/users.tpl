<div class="container-fluid">
<table class='table table-condensed table-hover'>
	<thead>
		<tr>
			<th>ID</th>
			<th>username</th>
			<th>email</th>
			<th>password</th>
			<th>gold</th>
			<th>active</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$allUsers item=iUser}
		<tr>
			<td>{$iUser->ID}</td>
			<td>{$iUser->username}</td>
			<td>{$iUser->email}</td>
			<td>{$iUser->password}</td>
			<td>{$iUser->gold}</td>
			<td>{$iUser->active}</td>
		</tr>
		{/foreach}
	</tbody>
</table>

</div>


