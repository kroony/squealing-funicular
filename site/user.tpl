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
<br />
Change Password<br />
<form action="user.php" method="post">
<input type="hidden" name="action" value="changePassword">
<input type="hidden" name="ID" value="{$user->ID}">
New password: <input name="password1" type="password"><br />
Confirm new password: <input name="password2" type="password"><br />
<input type="submit" value="Submit">
</form>

TODO: change email, password

<div>