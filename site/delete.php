<?php

include_once("bootstrap.php");

include_once("hero/hero.php");

//@TODO add undead races to DB and change current race to matching Undead Race

$Hero = new Hero();
$Hero = $Hero->loadHero($_REQUEST['ID']);

$Hero->GiveToUser(146);//give the Hero to the monster user @TODO stop using ID's 

$Hero->Level = -1;
$Hero->CurrentHP = $Hero->MaxHP;

$Hero->SaveHero();

/*
$DeleteQuery = "DELETE FROM `kr00ny_sf`.`Hero` WHERE `Hero`.`ID` = " . $_REQUEST["ID"] . ";";

$db = DB::GetConn();
$db->query($DeleteQuery);*/

header("Location: home.php");
