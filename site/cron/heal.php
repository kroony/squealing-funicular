<?php
set_include_path("..");
include_once("bootstrap.php");

/*********Add XP*********/
include_once("hero/heroController.php");

$heroController = new heroController();
$res = $heroController->performGlobalHealing(0.1);

DB::GetConn()->query("UPDATE `Hero` SET CurrentHP = 1 WHERE CurrentHP <= 0 and CurrentHP > -Con ORDER BY RAND() LIMIT 1");
?>
