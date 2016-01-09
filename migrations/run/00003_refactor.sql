ALTER TABLE `Weapon` ADD `UserID` INT NOT NULL AFTER `ID`;

CREATE TABLE IF NOT EXISTS `weaponbase` (
  `ID` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `damagedie` int(11) NOT NULL,
  `damagequantity` int(11) NOT NULL,
  `minoffset` int(11) NOT NULL,
  `maxoffset` int(11) NOT NULL,
  `mincrit` int(11) NOT NULL,
  `maxcrit` int(11) NOT NULL,
  `damageattribute` text COLLATE utf8_unicode_ci NOT NULL,
  `positivenameadjective` text COLLATE utf8_unicode_ci NOT NULL,
  `negativenameadjective` text COLLATE utf8_unicode_ci NOT NULL,
  `startingweapon` tinyint(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `weaponbase`
--

INSERT INTO `weaponbase` (`ID`, `name`, `damagedie`, `damagequantity`, `minoffset`, `maxoffset`, `mincrit`, `maxcrit`, `damageattribute`, `positivenameadjective`, `negativenameadjective`, `startingweapon`) VALUES
(1, 'Sword', 6, 1, -2, 2, 1, 5, 'Str', 'Sharp|Keen|Honed|Deadly', 'Blunt|Rusty|Bent|Cracked', 1),
(2, 'Shortbow', 6, 1, -2, 2, 1, 5, 'Dex', 'Balanced|Quality', 'Loose|Split', 1),
(3, 'Wand', 6, 1, -2, 2, 1, 5, 'Intel', 'Powered|Charged', 'Drained|Cracked', 1),
(4, 'Staff', 6, 1, -2, 2, 1, 5, 'Wis', 'Ornate|Precise', 'Flimsy|Crooked', 1);