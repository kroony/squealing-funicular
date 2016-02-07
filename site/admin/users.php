<?php

chdir("../");

include_once("bootstrap.php");

$db = DB::GetConn();
//print_r($db->query("UPDATE `AdvClass` SET `Description` = 'For every member of your guild it all starts here, everyone was a commoner once but few like to admit it. From here is where a commoner progress''s towards the path they will walk till their end. Whether martial or arcane, the commoner represents the blank slate and whatever guiding hand fate may lend is at its strongest here. A commoner''s life is easy but it doesn''t last, whether death or promotion, for commoner''s it''s all or nothing.', `Quote` = 'It''s an interesting gamble for a commoner to join a guild. On the one hand they''re jeopardizing a peaceful life free of danger by joining but on the other if they don''t they will probably never know adventure.' WHERE `AdvClass`.`ID` = 1;"));
//print_r($db->query("UPDATE `AdvClass` SET `Description` = 'Those wanting training and seeking a life of honour and loyalty need only become a Squire. Sworn into service under a Knight, Squire''s are trained in weapons, armour, and various other skills. It''s not an easy life for a Squire and many don''t survive, following their Knight into battle may seem great at first but being in the midst of the thickest fighting means many young Squires are killed by stray swings or just as easy kills. Those that survive however find themselves quickly on the road to knighthood or pick up a bow and learn to stay out of the fight.', `Quote` = 'It does not take much to be a squire, anyone can carry my sword but what I need is a Squire who knows to not give me the pointy end.' WHERE `AdvClass`.`ID` = 2;"));
//print_r($db->query("UPDATE `AdvClass` SET `Description` = 'Some people just want to fight, they don''t care about discipline or honour, just the violence. There is always work for a Brawler, cheap, dirty but always plentiful. The drawback however is that most don''t survive because as much as they might love violence there will always be someone out there better at it than them. That said Brawlers are hardy and those that live are survivors, either becoming Mercenaries seeking coin or Hunters seeking the next target.', `Quote` = 'Love me a good brawl, you know what else I love? Being surrounded by others who like a good brawl and lucky for me there is plenty of us.' WHERE `AdvClass`.`ID` = 3;"));
//print_r($db->query("UPDATE `AdvClass` SET `Description` = 'No one becomes a knight straight out of their standing as a Squire, there is training that only time can provide and this is the purpose of the Soldier. The main contingent of any army, soldiers make up the rank and file. Disciplined and well trained, they provide the support the knights need to take and hold any objective.', `Quote` = 'Better armed, better trained. Give me ten soldiers and I''ll give you whatever you point at.' WHERE `AdvClass`.`ID` = 4;"));
//print_r($db->query("UPDATE `AdvClass` SET `Description` = 'During their time as a Squire many learn that the best way to survive is to stay out of the conflict as much as possible. There are those that abandon their knights but for a good many, they find the best way to support their Knight is with a bow. These Squires become Archers, skilled ranged combatants that in enough numbers can take down any target from range.', `Quote` = 'And the sky darkened, an eclipse we thought, and then the sky fell upon us. In that moment we realised, magic wasn''t the only thing that could blot out the sun.' WHERE `AdvClass`.`ID` = 5;"));
//print_r($db->query("UPDATE `AdvClass` SET `Description` = 'Sometimes when a Squire picks up a bow to distance themselves from a conflict they sometimes remove themselves entirely or get separated from the rest. Those that survive often learn to get along in the wild, hunting and foraging from the land to get by. If they don''t die these people eventually become known as Hunters, serving as protectors and guides through the wilderness for their guilds.', `Quote` = 'Something needs to be understood, we''re all just animals. Humans, Elves, Dwarves, doesn''t matter. In the end we''re all animals waiting to be hunted.' WHERE `AdvClass`.`ID` = 6;"));
//print_r($db->query("UPDATE `AdvClass` SET `Description` = 'Eventually for the Brawler they come to an understanding that despite all the fights they survive. One thing will always win out, the need for money.', `Quote` = 'Honestly, for the right price I''ll do almost anything.' WHERE `AdvClass`.`ID` = 7;"));

include_once("user/userController.php");
include_once("user/heroController.php");

//html header
$smarty->display("css/css.tpl");

$userController = new userController();

$heroController = new heroController();

//menu
$smarty->display("menu.tpl");

/*********  show all Users  ***********/
$allUsers = $userController->getAll();
$smarty->assign("heroController",$heroController);
$smarty->assign("allUsers",$allUsers);
$smarty->display("admin/users.tpl");
/*********  end show all Users  ***********/

?>
