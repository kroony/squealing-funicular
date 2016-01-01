<?php

include_once("bootstrap.php");

$DeleteQuery = "DELETE FROM `kr00ny_sf`.`Hero` WHERE `Hero`.`ID` = " . $_REQUEST["ID"] . ";";

$db = DB::GetConn();
$db->query($DeleteQuery);

header("Location: home.php");
