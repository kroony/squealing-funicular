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

function humanTiming ($time)
{
  $time = time() - $time->getTimestamp(); // to get the time since that moment
  $time = ($time<1)? 1 : $time;
  $tokens = array (
    31536000 => 'year',
    2592000 => 'month',
    604800 => 'week',
    86400 => 'day',
    3600 => 'hour',
    60 => 'minute',
    1 => 'second'
  );

  foreach ($tokens as $unit => $text) {
    if ($time < $unit) continue;
    $numberOfUnits = floor($time / $unit);
    return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
  }
}
