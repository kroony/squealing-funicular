<?php

include_once("bootstrap.php");

include_once("hero/hero.php");

$Hero = new Hero();
$Hero = $testHero->loadHero($_REQUEST['ID']);

$Hero->GiveToUser(146);//give the Hero to the monster user 

$Hero->Level = -1;
$Hero->CurrentHP = $Hero->MaxHP;

$Hero->SaveHero();

/*
$DeleteQuery = "DELETE FROM `kr00ny_sf`.`Hero` WHERE `Hero`.`ID` = " . $_REQUEST["ID"] . ";";

$db = DB::GetConn();
$db->query($DeleteQuery);*/

header("Location: home.php");
