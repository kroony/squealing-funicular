<?php

include("bootstrap.php");
include_once("hero/weaponController.php");

//load User
include_once("user/user.php");
$user = new User();
$user = $user->load($currentUID);

$smarty->display("css/css.tpl");
$smarty->display("menu.tpl");

$weaponController = new weaponController();

$weapon = new Weapon();
$weapon = $weapon->loadWeapon($_REQUEST['ID']);

if($weapon->UserID == $currentUID)//check weapon belongs to current user 
{
	if(isset($_REQUEST['action']))//check if we are doing anything
	{	
		if($_REQUEST['action'] == "editWeaponName")
		{
			$weapon = Weapon::loadWeapon($_REQUEST['WeaponID']);
			if($weapon->UserID == $currentUID)
			{
				$oldName = $weapon->Name;
				$weapon->Name = $_REQUEST['weaponName'];
				$weapon->save();
				
				$smarty->assign("message", $oldName . " was renamed to " . $weapon->Name);
				$hero->Weapon = $weapon;
				$smarty->assign("hero",$hero);
			}
			else
			{
				$smarty->assign("error","You can't rename what does not belong to you.");
			}
		}
	}
	else// we are just viewing Weapon
	{
		$smarty->assign("weapon",$weapon);
	}
}
else
{
	$smarty->assign("error","This weapon does not belong to you");
}

$smarty->display("viewWeapon.tpl");
?>

