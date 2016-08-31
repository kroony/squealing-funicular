<?php
chdir("../");

include_once("bootstrap.php");

$db = DB::GetConn();

print_r($db->query("ALTER TABLE  `Message` ADD  `Type` INT NOT NULL ;"));
echo "<br /><br />";
/*
print_r($db->query("ALTER TABLE `User` ADD `refererID` INT NOT NULL AFTER `active`;"));
echo "<br /><br />";
*/
//html header
$smarty->display("css/css.tpl");

//menu
$smarty->display("menu.tpl");

/*********  show all Migrations  ***********/
$db = DB::GetConn();
$getQuery = "SELECT * FROM `migrations`;";
$res=$db->query($getQuery);//execute query

$migrations = array();
while($obj = $res->fetchObject())
{
  array_push($migrations, $obj);
}

$smarty->assign("migrations",$migrations);
$smarty->display("admin/migrations.tpl");
/*********  end show all Party  ***********/

chdir("admin/");

?>
