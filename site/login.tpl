{if $result == "login_error"}
	Problem with login Details please try again <a href="index.php">Click Here</a>
{else if $result == "activate"}
	Please 1st activate your account before loging in, to do this check in your inbox and follow the activate my account link';
{else}
	Login success, redirecting!
{/if}
