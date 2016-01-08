<?php
set_include_path("..");
require_once("includes/database.class.php");

include_once("hero/heroController.php");

$heroController = new heroController();
$res = $heroController->performGlobalHealing(0.1);

//Auto Resurrect Monster Heroes
$db = DB::GetConn();
$db->query("UPDATE `Hero` SET CurrentHP = 1 WHERE CurrentHP <= 0 and CurrentHP > -Con and OwnerID = 146 ORDER BY RAND() LIMIT 1");

?>
