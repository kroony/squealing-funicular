<?php

require_once("includes/database.class.php");
require_once("includes/session.php");
require_once('includes/smarty/libs/Smarty.class.php');

$smarty = new Smarty();
$smarty->force_compile = true; //@todo make this only true for dev environments (afterd deploys of new code we'll need to clear templates_c to ensure changes are reflected on the site)
$NotificationEmail="sf@trout-slap.com";

if($currentUID == 1)
{
  $smarty->assign("admin",true);
}
