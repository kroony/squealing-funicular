<?php
session_start();

$not_auth_pages = array("/index.php","/login.php","/register.php");
$currentUID = null;
if(!isset($_SESSION['userID'])) {
	if(!in_array($_SERVER['PHP_SELF'],$not_auth_pages)) {
		//only redirect if we're not already on the index page
		header( 'Location: index.php' );
		exit(0);
 	}
}	
else {
	$currentUID = $_SESSION['userID'];
}
?>
