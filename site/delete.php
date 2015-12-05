<?php

include_once("includes/connect.php");

$DeleteQuery = "DELETE FROM `kr00ny_sf`.`Hero` WHERE `Hero`.`ID` = " . $_REQUEST["ID"] . ";";
    
mysql_query($DeleteQuery);

header("Location: index.php");

?>