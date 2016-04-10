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
	
	<p>
		Is something not working how you would expect?<br />
		Did you see a weird error or something else you feel that was displayed incorrectly?<br />
		Just have a cool idea for a new feature or improvement?<br />
		Use the form below to inform the developers.
	</p>

	<form class="form-horizontal" role="form" action="bug.php">
		<div class="form-group">
			<label class="control-label col-sm-2" for="subject">Subject</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="subject" name="subject" placeholder="A brief outline">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="body">Body:</label>
			<div class="col-sm-10"> 
				<textarea rows="4" cols="50" class="form-control" id="body" name="body" placeholder="A detailed description"></textarea>
			</div>
		</div>
		<div class="form-group"> 
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" name="submit" class="btn btn-default">Submit</button>
			</div>
		</div>
	</form>
</div>