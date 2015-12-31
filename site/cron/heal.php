<?php
set_include_path("..");
include_once("includes/connect.php");

/*********Add XP*********/
include_once("hero/heroController.php");

$heroController = new heroController();
$res = $heroController->performGlobalHealing(0.1);
?>