<?php

include_once("includes/connect.php");

/*********Generate Adventurer*********/
include_once("adventurer/adventurer.php");
$testAdventurer = new Adventurer();

$testAdventurer->GenerateAdventurer(2); //generate lvl1 adventurer

//save adventurer
$testAdventurer->SaveAdventurer();

/***********end generate Adventurer *********/


header("Location: index.php");

?>