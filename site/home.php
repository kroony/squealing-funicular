<?php

include_once("bootstrap.php");
include_once("hero/heroController.php");
include_once("hero/weaponController.php");

$db = DB::GetConn();
$db->query("INSERT INTO `weaponbase` (`ID`, `name`, `damagedie`, `damagequantity`, `minoffset`, `maxoffset`, `mincrit`, `maxcrit`, `damageattribute`, `positivenameadjective`, `negativenameadjective`, `startingweapon`, `npcweapon`) VALUES (NULL, 'Mace', '8', '1', '-2', '2', '0', '6', 'Str', 'Polished|Blessed|Honed|Deadly', 'Dented|Rusty|Cursed|Cracked', '0', '1');");
$db->query("INSERT INTO `weaponbase` (`ID`, `name`, `damagedie`, `damagequantity`, `minoffset`, `maxoffset`, `mincrit`, `maxcrit`, `damageattribute`, `positivenameadjective`, `negativenameadjective`, `startingweapon`, `npcweapon`) VALUES (NULL, 'Longbow', '8', '1', '-2', '2', '0', '6', 'Dex', 'Balanced|Quality', 'Loose|Split', '0', '1');");
$db->query("INSERT INTO `weaponbase` (`ID`, `name`, `damagedie`, `damagequantity`, `minoffset`, `maxoffset`, `mincrit`, `maxcrit`, `damageattribute`, `positivenameadjective`, `negativenameadjective`, `startingweapon`, `npcweapon`) VALUES (NULL, 'Rod', '8', '1', '-2', '2', '0', '6', 'Intel', 'Powered|Charged', 'Drained|Cracked', '0', '1');");
$db->query("INSERT INTO `weaponbase` (`ID`, `name`, `damagedie`, `damagequantity`, `minoffset`, `maxoffset`, `mincrit`, `maxcrit`, `damageattribute`, `positivenameadjective`, `negativenameadjective`, `startingweapon`, `npcweapon`) VALUES (NULL, 'Quarterstaff', '8', '1', '-2', '2', '0', '6', 'Wis', 'Ornate|Precise', 'Flimsy|Crooked', '0', '1');");


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
