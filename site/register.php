<?php

$created = false;
$error_message = "";

if (isset($_REQUEST['username']))
{
	$user = mysql_real_escape_string($_REQUST['username']);
	$pass = "pass";

	$q1 = "SELECT * FROM `User` WHERE `username` = '$user'";
	$result1=mysql_query($q1);
	$num1=mysql_numrows($result1);
	if($num1 == 0)
	{
		mysql_query("INSERT INTO `User` (`username`, `password`) VALUES ($user, $pass)";
		$created = true;
	}
	else
	{
		$created = false;
		$error_message = "<b>Sorry, that username is already taken</b>";
	}
}
	
if ($created)
{
	
	?>
	You have successfully created a new user.
	<br />
	Your username is "<?php echo $user ?>" and your password is "pass".
	<br />
	You can log in <a href="index.php">here</a>.
	<?php
}
else
{
	echo $error_message;
	?>
	Register a new user!
	<br />
	<hr>
	<br />
	<form action="register.php" method="post">
	  Username: <input name="username" type="text"><br />
	  <input type="submit" value="Submit">
	</form>
	<?php
}

?>