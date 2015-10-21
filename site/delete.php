<?php

include_once("includes/connect.php");

$DeleteQuery = "DELETE FROM `kr00ny_sf`.`Adventurer` WHERE `Adventurer`.`ID` = " . $_REQUEST["ID"] . ";";
    
mysql_query($DeleteQuery);

header("Location: index.php");

?>