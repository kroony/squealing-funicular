<?php

include_once("includes/connect.php");

/*********get email config*********/
/*$configQuery = "SELECT `ConfigValue` FROM Config WHERE `ConfigKey` = 'notification_email';";

$configResult=mysql_query($configQuery);//execute query
$notificationEmail=mysql_result($configResult,$i,"ConfigValue");

echo $notificationEmail;*/
/**********end get email config********/

/******** rand() test   ****************/

$i=0;
$rolls = array();
while($i<600)
{
  array_push($rolls, rand(1,6));
  $i++;
}

$occurences = array_count_values($rolls);
ksort($occurences);
print_r($occurences);

/******** end rand() test   ****************/

//show link to generate new
echo '<p><a href="addNew.php">Generate</a></p>';

/*********  show all adventurers  ***********/
include_once("adventurer/adventurerController.php");

$adventurerController = new adventurerController();

$adventurerController->showAll();

/*********  end show all adventurers  ***********/


?>