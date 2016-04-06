<?php
set_include_path("..");
require_once("includes/database.class.php");
include_once("hero/heroController.php");

$heroController = new heroController();
$heroController->preformGlobalAge();

?>