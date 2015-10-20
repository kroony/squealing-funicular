<?php

include_once("includes/connect.php");

//get email config
$configQuery = "SELECT `ConfigValue` FROM Config WHERE `ConfigKey` = 'notification_email';";

$configResult=mysql_query($configQuery);//execute query
$notificationEmail=mysql_result($configResult,$i,"ConfigValue");

echo $notificationEmail;


?>