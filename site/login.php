<?php

include_once("includes/connect.php");

$Username = mysql_real_escape_string($_REQUEST['username']);
$Pass = mysql_real_escape_string($_REQUEST['password']);

//if($Username != '' || $Pass != '')
//{
	$q1 = "SELECT * FROM `User` WHERE `username` = '$Username' AND `password` = '$Pass'";
	$result1=mysql_query($q1);
	$num1=mysql_numrows($result1);
	if($num1 == 0)
	{
		echo 'Problem with login Details please try again <a href="index.php">Click Here</a>';
	}
	else
	{
		$active=mysql_result($result1, 0,"active");
		if($active = 1)
		{
			$ID=mysql_result($result1, 0,"ID");
			
			session_start();
			$_SESSION['userID'] = $ID;
			
			header( 'Location: home.php' );
		}
		else
		{
			echo 'Please 1st activate your account before loging in, to do this check in your inbox and follow the activate my account link';
		}
	}
//}
//else
//{
//echo "error... <br />Username: $Username <br />Pass: $Pass";
//}

?>