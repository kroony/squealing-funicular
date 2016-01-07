<?php
set_include_path("..");
require_once("includes/database.class.php");

/*********Add XP*********/
include_once("hero/heroController.php");

$heroController = new heroController();
$res = $heroController->performGlobalHealing(0.1);

//@TODO flag somewhere the last time this was run and display it somewhere on the site. 


//Auto Resurect Monster Heros
$db = DB::GetConn();
$db->query("UPDATE `Hero` SET CurrentHP = 1 WHERE CurrentHP <= 0 and CurrentHP > -Con and OwnerID = 146 ORDER BY RAND() LIMIT 1");

?>
