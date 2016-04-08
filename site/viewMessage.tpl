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

<br />
Sent: {$message->Sent->format('Y-m-d H:i:s')}
From: {$fromUser->username}<br />
Subject: {$message->Subject}gp<br /><br />
Body:<br />
{$message->Body}
<br />


<div>