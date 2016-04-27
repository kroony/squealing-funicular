<div class="container-fluid">
{if isset($message)}
	<div class="alert alert-info">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		{$message}
	</div>
{/if}
{if isset($error)}
	<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		{$error}
	</div>
{/if}

<table class='table table-condensed table-hover'>
	<thead>
	  <tr>
		  <th>Seller</th>
		  <th>Item Details</th>
		  <th>Price</th>
		  <th>Action</th>
	  </tr>
	</thead>
	<tbody>
		{foreach from=$saleItems item=sale}
		<tr>
			<td>{$sale->SellerID}</td>
			<td>{$sale->ItemType}</td>
			<td>{$sale->ItemID}</td>
			<td>{$sale->Price}gp</td>
		</tr>
		{/foreach}
	</tbody>
</table>
</div>