<?php

include_once("includes/connect.php");
include_once("includes/session.php");
include_once("hero/heroController.php");


$heroController = new heroController();


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
echo '<p>
        Generate Level: 
        <a href="addNew.php?level=1">1</a> 
        <a href="addNew.php?level=2">2</a> 
        <a href="addNew.php?level=3">3</a> 
        <a href="addNew.php?level=4">4</a> 
        <a href="addNew.php?level=5">5</a> 
        <a href="addNew.php?level=6">6</a> 
        <a href="addNew.php?level=7">7</a> 
        <a href="addNew.php?level=8">8</a> 
        <a href="addNew.php?level=9">9</a> 
        <a href="addNew.php?level=10">10</a> 
        <a href="addNew.php?level=20">20</a> 
        <a href="addNew.php?level=30">30</a> 
        <a href="addNew.php?level=40">40</a> 
        <a href="addNew.php?level=50">50</a> 
        <a href="addNew.php?level=60">60</a> 
        <a href="addNew.php?level=70">70</a> 
        <a href="addNew.php?level=80">80</a> 
        <a href="addNew.php?level=90">90</a> 
        <a href="addNew.php?level=100">100</a> 
      </p>';

/*********  Fight Options  ***********/
echo '
<p>
<form action="oneonone.php">
	<select name="ID1">
		<option>Select your fighter</option>
		' . $heroController->dropDownForUser($currentUID) . '
	</select> VS 
	<select name="ID2">
		<option>Select your opponent</option>
		' . $heroController->dropDownForUserEnemys($currentUID) . '
	</select> <input type="submit">
</form>
</p>';
	  
	  
/*********  show all Hero  ***********/

$heroController->showAllForUser($currentUID);

/*********  end show all Hero  ***********/


?>