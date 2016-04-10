<div class="container-fluid">
{if isset($notification_message)}
	<div class="alert alert-info">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		{$notification_message}
	</div>
{/if}
{if isset($error)}
	<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		{$error}
	</div>
{/if}

<br />
Sent: {$message->Sent->format('Y-m-d H:i:s')}<br />
From: {$fromUser->username}<br />
Subject: {$message->Subject}<br /><br />
<strong>Body</strong><br />
{$message->Body}
<br />


<div>