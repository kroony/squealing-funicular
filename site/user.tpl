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
Recruitment Link: <a href="http://sf.amospheric.com/register.php?Referer={$user->ID}" target="_blank">http://sf.amospheric.com/register.php?Referer={$user->ID}</a> Users who register using this link will credit you a finders fee each time they pay to hire a new hero.<br />
<br />

<strong>Messages</strong>
<br />
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#deleteAllModal">Delete All Messages</button>
<div class="modal fade" id="deleteAllModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body">
          <p><a href="user.php?action=deleteAllMessages">Click here to delete all your messages</a></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
<br />
<table class='table table-condensed table-hover'>
	<thead>
		<tr>
			<th>Sent</th>
			<th>From</th>
			<th>Subject</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$messages item=message}
		<tr {if !$message->IsRead} style="background-color: beige;"{/if}>
			<td><a href="viewMessage.php?ID={$message->ID}">{humanTiming($message->Sent)} ago</a></td>
			<td><a href="viewUser.php?ID={$message->FromID}">{$tmpUser->load($message->FromID)->username}</a></td>
			<td>{$message->Subject}</td>
			<td>
				<div class="btn-group">
					<button type="button" class="btn btn-default"><a href="viewMessage.php?ID={$message->ID}&action=reply"><span class="glyphicon glyphicon-share-alt icon-flipped" data-toggle="tooltip" title="Reply to Message"></span></a></button>
					<button type="button" class="btn btn-default"><a href="user.php?MsgID={$message->ID}&action=DeleteMessage"><span class="glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete Message"> </span></a></button>
				</div>
			</td>
			
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