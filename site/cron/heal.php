<?php
set_include_path("..");
require_once("includes/database.class.php");

/*********Add XP*********/
include_once("hero/heroController.php");

$heroController = new heroController();
$res = $heroController->performGlobalHealing(0.1);

//@TODO flag somewhere the last time this was run and display it somewhere on the site. 


//commented out so no AUTO resurections
/*$db = DB::GetConn();
$db->query("UPDATE `Hero` SET CurrentHP = 1 WHERE CurrentHP <= 0 and CurrentHP > -Con ORDER BY RAND() LIMIT 1");*/

?>
