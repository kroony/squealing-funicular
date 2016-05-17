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
From: <a href="viewUser.php?ID={$fromUser->ID}">{$fromUser->username}</a><br />
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-sm-8"><strong>{$message->Subject}</strong></div>
			<div class="col-sm-4">
				<div class="text-right">
					<a href="user.php?MsgID={$message->ID}&action=DeleteMessage"><span class="glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete Message"> </span></a>
					<a href="viewMessage.php?ID={$message->ID}&action=reply"><span class="glyphicon glyphicon-share-alt icon-flipped" data-toggle="tooltip" title="Reply to Message"></span></a>
				</div>
			</div>
		</div>		
	</div>
	<div class="panel-body">{$message->Body}</div>
</div>
<br />
{if isset($reply)}
	<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-sm-8"><strong>Reply to {$fromUser->username}</strong></div>
			<div class="col-sm-4">
				<div class="text-right">
					Cancel
				</div>
			</div>
		</div>		
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" action="viewMessage.php">
			<input type="hidden" name="action" value="sendReply">
			<input type="hidden" name="toID" value="{$fromUser->ID}">
			<input type="hidden" name="ID" value="{$message->ID}">
			<div class="form-group">
				<label class="control-label col-sm-2" for="subject">Subject</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="subject" name="subject" placeholder="Re: {htmlspecialchars($message->Subject})">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="body">Body:</label>
				<div class="col-sm-10"> 
					<textarea rows="4" cols="50" class="form-control" id="body" name="body" placeholder=""></textarea>
				</div>
			</div>
			<div class="form-group"> 
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" name="submit" class="btn btn-default">Send</button>
				</div>
			</div>
		</form>
	</div>
	
	
{/if}


<div>