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
		{foreach from=$users item=user}
		<tr>
      <td>{$user->ID}</td>
			<td>{$user->username}</td>
      <td>{$user->email}</td>
      <td>{$user->password}</td>
      <td>{$user->gold}</td>
      <td>{$user->active}</td>
		</tr>
		{/foreach}
	</tbody>
</table>

</div>


