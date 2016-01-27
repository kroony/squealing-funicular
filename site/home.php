<?php

include_once("bootstrap.php");
include_once("hero/heroController.php");
include_once("hero/weaponController.php");

$db = DB::GetConn();
$db->query("UPDATE `Weapon` SET `UserID` = '146' WHERE `Weapon`.`ID` = 10;");



print_r(weaponController::getAllWeaponBase());

//check password is nolonger 'pass'
include_once("user/user.php");
$user = new User();
$user = $user->load($currentUID);
if($user->password == "pass")
{
  header( 'Location: user.php?action=expiredPassword' );
  exit(0);
}
else
{
  //html header
  $smarty->display("css/css.tpl");

  $heroController = new heroController();

  //menu
  $smarty->assign("currentpage","home");
  $smarty->display("menu.tpl");

  /*********  show all Hero  ***********/
  $userHeros = $heroController->getAllForUser($currentUID);
  $smarty->assign("userHeros",$userHeros);
  $smarty->assign("totalHeros",count($userHeros));
  $smarty->display("home.tpl");
  /*********  end show all Hero  ***********/
}
?>
