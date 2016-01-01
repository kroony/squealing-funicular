<?php

include_once("bootstrap.php");
include_once("hero/heroController.php");


$heroController = new heroController();


/*********get email config*********/
/*$configQuery = "SELECT `ConfigValue` FROM Config WHERE `ConfigKey` = 'notification_email';";

$configResult=mysql_query($configQuery);//execute query
$notificationEmail=mysql_result($configResult,$i,"ConfigValue");

echo $notificationEmail;*/
/**********end get email config********/

//show link to generate new
/*echo '<p>
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
      </p>';*/
	  
/*********  show all Hero  ***********/

$totalHeros = $heroController->showAllForUser($currentUID);
$smarty->assign("totalHeros",$totalHeros);
$smarty->display("home.tpl");

		  
/*********  end show all Hero  ***********/


?>
