<?php
chdir("../");

include_once("bootstrap.php");

$db = DB::GetConn();

print_r($db->query("ALTER TABLE `User` ADD `kills` INT NOT NULL ;"));
echo "<br /><br />";
print_r($db->query("UPDATE `User`,( SELECT OwnerID, sum(`Kills`) as mysum
                   FROM Hero GROUP BY OwnerID) as s
   SET `User`.`kills` = s.mysum
  WHERE User.ID = s.OwnerID;"));

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
