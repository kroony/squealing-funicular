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
					<a href="viewUser.php?ID={$sale->OwnerID}">{$sale->GetOwner()->username}</a>
				{else}
					Owner Unknown (ID: {$sale->OwnerID})
				{/if}
			</td>
			<td>
				{if $sale->ItemType == "Weapon"}
					Weapon - {$sale->Item->Name} {$sale->Item->DamageQuantity}d{$sale->Item->DamageDie}{if $sale->Item->DamageOffset < 0}{$sale->Item->DamageOffset}{elseif $sale->Item->DamageOffset > 0}+{$sale->Item->DamageOffset}{/if} ({$sale->Item->CritChance}%)
				{/if}
			</td>
			<td>{$sale->Price}gp</td>
			<td>@TODO can afford checks</td>
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