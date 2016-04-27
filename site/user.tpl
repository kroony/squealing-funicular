<div class="container-fluid">
<h3>{$user->username}</h3>

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

<br />
Email: {$user->email}<br />
Gold: {number_format($user->gold)}gp<br />
Deaths: {$user->deaths}<br />
Kills: {$user->kills}<br />
<br />

<strong>Messages</strong><br />
<table class='table table-condensed table-hover'>
	<thead>
		<tr>
			<th>Sent</th>
			<th>From</th>
			<th>Subject</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$messages item=message}
		<tr {if !$message->IsRead} style="background-color: beige;"{/if}>
			<td><a href="viewMessage.php?ID={$message->ID}">{$message->Sent->format('Y-m-d H:i:s')}</a></td>
			<td><a href="viewUser.php?ID={$message->FromID}">{$tmpUser->load($message->FromID)->username}</a></td>
			<td>{$message->Subject}</td>
			<td><a href="user.php?MsgID={$message->ID}&action=DeleteMessage"><span class="glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete Message"></span></a></td>
			
		</tr>
		{/foreach}
	</tbody>
</table>


<br /><br />
<strong>Change Password</strong>
<form action="user.php" class="form-horizontal" role="form">
	<input type="hidden" name="action" value="changePassword">
	<input type="hidden" name="ID" value="{$user->ID}">
	<div class="form-group">
		<label class="control-label col-sm-2" for="email">Current Password:</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="oldpassword" placeholder="Current Password" name="oldpassword">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="email">New Password:</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="password1" placeholder="New Password" name="password1">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="pwd">Confirm New Password:</label>
		<div class="col-sm-10"> 
			<input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm New Password">
		</div>
	</div>
	<div class="form-group"> 
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">Submit</button>
		</div>
	</div>
</form>


TODO: change email

<div>