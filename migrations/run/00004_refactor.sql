INSERT INTO `AdvClass` (`ID`, `Name`, `HD`, `FavouredAttribute`, `LevelCap`, `NextClass`, `PrerequisiteAttribute`, `PrerequisiteTarget`, `PrerequisiteAge`, `Description`) VALUES
(17, 'Apprentice', 6, 'Intel', 12, '19|20', 'Intel', 11, 0, ''),
(18, 'Acolyte', 6, 'Wis', 10, '21|22', 'Wis', 11, 0, ''),
(19, 'Wizard', 6, 'Int', 20, '26|27|28|29', 'Int', 18, 0, ''),
(20, 'Witch', 6, 'Wis', 20, '27|28|29', 'Wis', 16, 0, ''),
(21, 'Cultist', 6, 'Cha', 15, '23|24', 'Wis', 15, 0, ''),
(22, 'Preist', 6, 'Cha', 15, '24|25', 'Cha', 15, 0, ''),
(23, 'Anti Paladin', 12, 'Str', 20, '', 'Str', 15, 0, ''),
(24, 'Cleric', 8, 'Cha', 20, '29|30', 'Cha', 18, 0, ''),
(25, 'Paladin', 10, 'Cha', 20, '30', 'Str', 15, 0, ''),
(26, 'Sorcerer', 8, 'Int', 40, '', 'Con', 15, 0, ''),
(27, 'Enchanter', 8, 'Int', 30, '31', 'Int', 22, 0, ''),
(28, 'Conjurer', 8, 'Wis', 30, '31', 'Wis', 20, 0, ''),
(29, 'Necromancer', 8, 'Con', 30, '', 'Cha', 22, 0, ''),
(30, 'Angel Whisperer', 10, 'Con', 30, '32', 'Cha', 22, 0, ''),
(31, 'Arch Mage', 8, 'Intel', 50, '', 'Intel', 28, 0, ''),
(32, 'Acendent', 10, 'Con', 50, '', 'Con', 20, 0, '');

UPDATE `AdvClass` SET `NextClass` = '2|3|17|18' WHERE `AdvClass`.`ID` = 1;

