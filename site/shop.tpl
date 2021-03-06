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
			<td>
				{if !empty($sale->GetOwner())}
					<a href="viewUser.php?ID={$sale->SellerID}">{$sale->GetOwner()->username}</a>
				{else}
					Owner Unknown (ID: {$sale->SellerID})
				{/if}
			</td>
			<td>
				{if $sale->ItemType == "Weapon"}
					Weapon - {$sale->Item->Name} {$sale->Item->DamageQuantity}d{$sale->Item->DamageDie}{if $sale->Item->DamageOffset < 0}{$sale->Item->DamageOffset}{elseif $sale->Item->DamageOffset > 0}+{$sale->Item->DamageOffset}{/if} ({$sale->Item->CritChance}%) {$sale->Item->DamageAttribute} 
				{/if}
			</td>
			<td>{number_format($sale->Price)}gp</td>
			<td>
				<div class="btn-group">
					{if $sale->isSeller($user->ID)}
						<button type="button" class="btn btn-default"><a href="shop.php?action=cancelSale&ID={$sale->ID}"><span class="glyphicon glyphicon-remove" data-toggle="tooltip" title="Cancel Sale"></span></a></button>
					{else}
						{if $user->canAfford($sale->Price)}
							<button type="button" class="btn btn-default"><a href="shop.php?action=buy&ID={$sale->ID}"><span class="glyphicon glyphicon-usd" data-toggle="tooltip" title="Purchase Item"></span></a></button>
						{else}
							<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-usd" data-toggle="tooltip" title="Can't Afford"></span></button>
						{/if}
					{/if}
				</div>
			</td>
		</tr>
		{/foreach}
		<form action="shop.php">
		<input type="hidden" name="action" value="createSale">
		<tr>
			<td><strong>Sell Your Weapon</strong></td>
			<td>
				<select name="WeaponID">
					<option>Select Weapon</option>
					{foreach from=$unequipedWeapons item=weapon}
					<option value="{$weapon->ID}">{$weapon->Name} {$weapon->DamageQuantity}d{$weapon->DamageDie}{if $weapon->DamageOffset < 0}{$weapon->DamageOffset}{elseif $weapon->DamageOffset > 0}+{$weapon->DamageOffset}{/if} ({$weapon->CritChance}%)</option>
					{/foreach}
				</select>
			</td>
			<td>
				<input type="text" name="price" value="0">
			</td>
			<td>
				<input type="submit" value="Submit">
			</td>
		</tr>
		</form>
			
	</tbody>
</table>
</div>