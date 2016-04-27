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
Heroes: {$heroCount}<br />
Deaths: {$user->deaths}<br />
<br />

<div>