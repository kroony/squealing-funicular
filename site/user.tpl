<h1>{$user->username}</h1>

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
email: {$user->email}<br />
gold: {$user->gold}<br />

<br />
<form action="user.php" method="post">
<input type="hidden" name="action" value="changePassword">
<input type="hidden" name="ID" value="{$user->ID}">
Password1: <input name="password1" type="password"><br />
Password2: <input name="password2" type="password"><br />
<input type="submit" value="Submit">
</form>

TODO: change email, password

