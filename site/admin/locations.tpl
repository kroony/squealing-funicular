<div class="container-fluid">
<table class='table table-condensed table-hover'>
	<thead>
		<tr>
      <th>ID</th>
			<th>Name</th>
      <th>StrBon</th>
      <th>DexBon</th>
      <th>ConBon</th>
      <th>IntelBon</th>
      <th>WisBon</th>
      <th>ChaBon</th>
      <th>FteBon</th>
      <th>OldAge</th>
      <th>Description</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$allLocations item=Location}
		<tr>
      <td>{$Location->ID}</td>
			<td>{$Location->Name}</td>
      <td>{$Location->StrBon}</td>
      <td>{$Location->DexBon}</td>
      <td>{$Location->ConBon}</td>
      <td>{$Location->IntelBon}</td>
      <td>{$Location->WisBon}</td>
      <td>{$Location->ChaBon}</td>
      <td>{$Location->FteBon}</td>
      <td>{$Location->OldAge}</td>
      <td>{$Location->Description}</td>
		</tr>
		{/foreach}
	</tbody>
</table>

</div>


