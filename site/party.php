<?php

include_once("bootstrap.php");
include_once("party/Party.php");

//html header
$smarty->display("css/css.tpl");

$partyController = new partyController();

//menu
$smarty->assign("currentpage","party");
$smarty->display("menu.tpl");

/*********  show all Party  ***********/
$userParties = $partyController->getAllForUser($currentUID);
$smarty->assign("userParties",$userParties);
$smarty->assign("totalParties",count($userParties));
$smarty->display("party.tpl");
/*********  end show all Party  ***********/

?>
