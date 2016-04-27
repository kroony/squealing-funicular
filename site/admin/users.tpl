<div class="container-fluid">
<table class='table table-condensed table-hover'>
	<thead>
		<tr>
			<th>ID</th>
			<th>username</th>
			<th>email</th>
			<th>password</th>
			<th>gold</th>
			<th>heroes</th>
			<th>deaths</th>
			<th>kills</th>
			<th>K:D Ratio</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$allUsers item=iUser}
		<tr>
			<td>{$iUser->ID}</td>
			<td>{$iUser->username}</td>
			<td>{$iUser->email}</td>
			<td>{if $iUser->password == "pass"}pass{else}Hashed{/if}</td>
			<td>{$iUser->gold}</td>
			<td>{$heroController->countAllForUser($iUser->ID)}</td>
			<td>{$iUser->deaths}</td>
			<td>{$iUser->kills}</td>
			<td>{if $iUser->deaths > 0){$iUser->kills / $iUser->deaths}{else}{$iUser->kills}{/if}</td>
		</tr>
		{/foreach}
	</tbody>
</table>

</div>


