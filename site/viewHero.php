<?php

include("bootstrap.php");

$smarty->display("css/css.tpl");

include_once("hero/heroController.php");

$heroController = new heroController();

$hero = new Hero();
$hero = $hero->loadHero($_REQUEST['ID']);

if($hero->GetOwner()->ID == $currentUID)//check hero belongs to current user 
{
	if(isset($_REQUEST['action']))//check if we are doing anything
	{	
		if($_REQUEST['action'] == "editName")
		{
			if($_REQUEST['heroName'] != "" && $_REQUEST['heroName'] != null)
			{
				$oldName = $hero->Name;
				$hero->Name = $_REQUEST['heroName'];
				$hero->SaveHero();
				
				$smarty->assign("message", $oldName . " was renamed to " . $hero->Name);
				$smarty->assign("hero",$hero);
			}
			else
			{
				$smarty->assign("error","Hero's name can not be blank");
				$smarty->assign("hero",$hero);
			}
		}
	}
	else// we are just viewing hero
	{
		$smarty->assign("hero",$hero);
	}
}
else
{
	$smarty->assign("error","This hero does not belong to you");
}

$smarty->display("viewHero.tpl");
?>

