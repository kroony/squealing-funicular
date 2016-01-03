<?php
set_include_path("..");
include_once("bootstrap.php");

/*********Add XP*********/
include_once("hero/heroController.php");

$heroController = new heroController();
$res = $heroController->performGlobalHealing(1);

//commented out so no AUTO resurections
/*$db = DB::GetConn();
$db->query("UPDATE `Hero` SET CurrentHP = 1 WHERE CurrentHP <= 0 and CurrentHP > -Con ORDER BY RAND() LIMIT 1");*/

?>
