<?php

class Race
{
  public $ID;
  public $Name;
  public $StrBon;
  public $DexBon;
  public $ConBon;
  public $IntelBon;
  public $WisBon;
  public $ChaBon;
  public $FteBon;
  public $OldAge;
  public $Description;
  //abilities or more unique bonuses?
  
  function __construct($Name, $StrBon, $DexBon, $ConBon, $IntelBon, $WisBon, $ChaBon, $FteBon, $OldAge, $Description)
  {
    $this->Name = $Name;
    $this->StrBon = $StrBon;
    $this->DexBon = $DexBon;
    $this->ConBon = $ConBon;
    $this->IntelBon = $IntelBon;
    $this->WisBon = $WisBon;
    $this->ChaBon = $ChaBon;
    $this->FteBon = $FteBon;
    $this->OldAge = $OldAge;
    $this->Description = $Description;
  }
  
  //load Race from DB 
  function loadRace($ID)
  {
    //check ID is not blank and exists and such
    
    $getQuery = "SELECT * FROM `Race` WHERE `ID` = '" . $ID . "';";

    $getResult=mysql_query($getQuery);//execute query
    $num=mysql_numrows($getResult);
    
    $ReturnRace = new Race(mysql_result($getResult,0,"Name"), 
                           mysql_result($getResult,0,"StrBon"), 
                           mysql_result($getResult,0,"DexBon"), 
                           mysql_result($getResult,0,"ConBon"), 
                           mysql_result($getResult,0,"IntelBon"), 
                           mysql_result($getResult,0,"WisBon"), 
                           mysql_result($getResult,0,"ChaBon"), 
                           mysql_result($getResult,0,"FteBon"), 
                           mysql_result($getResult,0,"OldAge"), 
                           mysql_result($getResult,0,"Description"));
    
    $ReturnRace->ID = $ID;
    
    return $ReturnRace;
  }
  
  function generateHeroName()
  {
    //pull from banks, random 1st name last name by race type
    //some cool name generator based on race?
	$f_max = 3;
	$l_max = 3;
	if ($this->Name == "Human")
	{
		$f_pre = array("saint-", "jon", "", "", "", "", "", "");
		$f_mid = array("pet", "jac", "cob", "er", "ic", "stef", "fan", "mer", "ril", "ley");
		$f_suf = array("of", "met", "ic", "im", "rum", "", "", "", "");

		$l_pre = array("o'", "mac", "free", "", "", "", "");
		$l_mid = array("smi", "ith", "co", "be", "er", "rob", "bert", "frank", "anne");
		$l_suf = array("son", "er", "well", "s", "", "", "", "");
	}
	else if ($this->Name == "Dwarf")
	{
		$f_pre = array("yun", "magh", "", "", "", "", "", "");
		$f_mid = array("thros", "grul", "lim", "dic", "haf", "af", "jim");
		$f_suf = array("of", "met", "ic", "im", "rum", "beard", "", "", "");

		$l_pre = array("von ", "", "", "", "", "", "");
		$l_mid = array("kim", "graf", "fit", "von", "bilt", "mar", "gold");
		$l_suf = array("mace", "maker", "forge", "", "", "", "", "", "");
	}
	else if ($this->Name == "Elf")
	{
		$f_pre = array("cap", "col", "fli", "", "", "", "", "");
		$f_mid = array("per", "mop", "flip", "don", "has", "gift", "ron", "san");
		$f_suf = array("on", "ine", "flew", "jon", "", "", "", "", "");

		$l_pre = array("feather", "light", "", "", "", "", "");
		$l_mid = array("cap", "per", "soft", "tree", "mel", "plum", "fart");
		$l_suf = array("foot", "sky", "trot", "", "", "", "", "", "");
	}
	else if ($this->Name == "Halfling")
	{
		$f_pre = array("", "", "", "", "", "", "", "");
		$f_mid = array("bil", "fro", "mul", "ber", "ry", "grem", "mil", "at", "et");
		$f_suf = array("o the");
		$f_max = 1;

		$l_pre = array();
		$l_mid = array("spoon", "hat", "bag", "word", "sword", "hobbit", "mead", "fly", "hog", "wolf", "badger");
		$l_suf = array("-fearer", "-worthy", "-slayer", "-drinker", "", "", "", "", "", "");
	}
	return $this->makeParts($f_max, $f_pre, $f_mid, $f_suf)
			. ' ' . 
		   $this->makeParts($l_max, $l_pre, $l_mid, $l_suf);
    
	/*$fName = array("Throsgrulim", "Yundic", "Havuck", "Maghamli", "Toremrum");
    $lName = array("Snowfall", "Koboldmace", "Plateforge", "Oremace", "Merrymaker");
    return $fName[rand(0,4)] . " " . $lName[rand(0,4)];*/
  }

  function makeParts($max_mid, $prefixes, $mids, $suffixes) {
    $num = rand(1,$max_mid);
	$nm = $this->pick($prefixes);
	$last_pick = null;
	for ($i = 0; $i != $num; ++$i) {
	  $pick = $this->pick($mids);
	  if ($pick != $last_pick) {
		$nm = $this->joinName($nm, $pick);
	  }
	  $last_pick = $pick;
	}
	$nm = $this->joinName($nm, $this->pick($suffixes));
	
	$nm = strtoupper(substr($nm, 0, 1)) . substr($nm, 1);
	
	return $nm;
  }
  function joinName($prefix, $suffix)
  {
    $a = substr($prefix, -1);
	$b = substr($suffix, 0, 1);
	$start = substr($prefix, 0, -1);
	$rest = substr($suffix, 1);
	// consonant mutation
	if ($a == $b && $a == 'f') {
	 return $start . 'v' . $rest;
	}
	else if ($a == $b && $a != 's') {
	  return $prefix . $rest;
	}
	else if ($a == 'c' && $a != 's') {
	  return $start . 'x' . $rest;
	}
	
	return $prefix . $suffix;
  }
  function pick($array)
  {
    $r = rand(0, count($array));
	return $array[$r];
  }
}

?>
