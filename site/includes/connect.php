<?php
$DBusername="kr00ny_sfUser";
$DBpassword="}8FCULdmEgqo";
$database="kr00ny_sf";

mysql_connect(localhost,$DBusername,$DBpassword);

@mysql_select_db($database) or die( "Unable to select database");

//Config Values

//Notification Email address
$NotificationEmail="sf@trout-slap.com";
?>