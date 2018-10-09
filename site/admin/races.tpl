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
		{foreach from=$allRaces item=Race}
		<tr>
      <td>{$Race->ID}</td>
			<td>{$Race->Name}</td>
      <td>{$Race->StrBon}</td>
      <td>{$Race->DexBon}</td>
      <td>{$Race->ConBon}</td>
      <td>{$Race->IntelBon}</td>
      <td>{$Race->WisBon}</td>
      <td>{$Race->ChaBon}</td>
      <td>{$Race->FteBon}</td>
      <td>{$Race->OldAge}</td>
      <td>{$Race->Description}</td>
		</tr>
		{/foreach}
	</tbody>
</table>

</div>


