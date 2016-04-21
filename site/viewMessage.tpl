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
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-sm-8"><strong>{$message->Subject}</strong></div>
			<div class="col-sm-4">
				<div class="text-right">
					<a href="user.php?MsgID={$message->ID}&action=DeleteMessage"><span class="glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete Message"></span></a>
				</div>
			</div>
		</div>		
	</div>
	<div class="panel-body">{$message->Body}</div>
</div>


<div>