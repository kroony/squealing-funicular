<?php

include_once("includes/connect.php");


$created = false;
$error_message = "";

$user = mysql_real_escape_string($_REQUEST['username']);
$pass = "pass";

if (isset($_REQUEST['username']))
{
	$q1 = "SELECT * FROM `User` WHERE `username` = '$user'";
	$result1=mysql_query($q1);
	$num1=mysql_numrows($result1);
	if($num1 == 0)
	{
		$q = "INSERT INTO `User` (`username`, `password`, `email`, `salt`, `gold`, `active`) VALUES ('$user', '$pass', '', 0, 0, 1)";
		mysql_query($q);
		$created = true;
	}
	else
	{
		$created = false;
		$error_message = "<b>Sorry, that username is already taken</b><hr />";
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