-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 31, 2015 at 09:25 PM
-- Server version: 5.5.42-37.1
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kr00ny_sf`
--

-- --------------------------------------------------------

--
-- Table structure for table `AdvClass`
--

CREATE TABLE IF NOT EXISTS `AdvClass` (
  `ID` int(11) NOT NULL,
  `Name` text COLLATE utf8_unicode_ci NOT NULL,
  `HD` int(11) NOT NULL,
  `FavouredAttribute` text COLLATE utf8_unicode_ci NOT NULL,
  `LevelCap` int(11) NOT NULL,
  `NextClass` text COLLATE utf8_unicode_ci NOT NULL,
  `PrerequisiteAttribute` text COLLATE utf8_unicode_ci NOT NULL,
  `PrerequisiteTarget` int(11) NOT NULL,
  `PrerequisiteAge` int(11) NOT NULL,
  `Description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `AdvClass`
--

INSERT INTO `AdvClass` (`ID`, `Name`, `HD`, `FavouredAttribute`, `LevelCap`, `NextClass`, `PrerequisiteAttribute`, `PrerequisiteTarget`, `PrerequisiteAge`, `Description`) VALUES
(1, 'Commoner', 4, 'Fte', 5, '2|3', 'Str', 0, 0, 'A commoner come to start an exciting life in adventuring.'),
(2, 'Squire', 6, 'Str', 10, '4|5', 'Intel', 8, 12, 'Martial character starting training in the organised military'),
(3, 'Brawler', 6, 'Con', 10, '6|7', 'Str', 8, 13, 'Self Trained Martial Character'),
(4, 'Soldier', 8, 'Str', 20, '8|13', 'Str', 12, 15, 'General military unit'),
(5, 'Archer', 6, 'Dex', 20, '8|9|10', 'Dex', 12, 15, 'Archer military unit'),
(6, 'Hunter', 6, 'Wis', 20, '10|11|12', 'Dex', 12, 15, 'Self Trained Archer wildman'),
(7, 'Mercenary', 8, 'Con', 20, '13|12', 'Con', 12, 15, 'Sell Sword'),
(8, 'Knight', 10, 'Str', 30, '14', 'Str', 25, 21, 'Commanding Military Unit'),
(9, 'Sharpshooter', 8, 'Dex', 40, '', 'Dex', 27, 21, 'Shoot the dots of a dice at 100 yeards'),
(10, 'Ranger', 8, 'Dex', 30, '13', 'Wis', 25, 20, 'Knows how to use and live off the land'),
(11, 'Druid', 8, 'Wis', 40, '', 'Wis', 30, 20, 'Spiritually in line with nature'),
(12, 'Assassin', 10, 'Dex', 30, '15', 'Intel', 25, 21, 'Profoundly good at killing'),
(13, 'Cavalier', 10, 'Str', 30, '16', 'Cha', 20, 21, 'Tactical commander of military units'),
(14, 'Warden', 12, 'Str', 50, '', 'Wis', 15, 30, 'Knight of Knights'),
(15, 'Reaper', 12, 'Dex', 50, '', 'Intel', 30, 30, 'No longer seeks worldly reparations for killing'),
(16, 'Marshall', 12, 'Str', 50, '', 'Cha', 25, 30, 'Marshall Description ');

-- --------------------------------------------------------

--
-- Table structure for table `Config`
--

CREATE TABLE IF NOT EXISTS `Config` (
  `ConfigKey` text COLLATE utf8_unicode_ci NOT NULL,
  `ConfigValue` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Config`
--

INSERT INTO `Config` (`ConfigKey`, `ConfigValue`) VALUES
('notification_email', 'kroony@trout-slap.com');

-- --------------------------------------------------------

--
-- Table structure for table `Hero`
--

CREATE TABLE IF NOT EXISTS `Hero` (
  `ID` int(11) NOT NULL,
  `OwnerID` int(11) NOT NULL,
  `PartyID` int(11) NOT NULL,
  `Name` text COLLATE utf8_unicode_ci NOT NULL,
  `Race` text COLLATE utf8_unicode_ci NOT NULL,
  `Class` text COLLATE utf8_unicode_ci NOT NULL,
  `MaxHP` int(11) NOT NULL,
  `CurrentHP` float NOT NULL,
  `Level` int(11) NOT NULL,
  `CurrentXP` int(11) NOT NULL,
  `LevelUpXP` int(11) NOT NULL,
  `Str` int(11) NOT NULL,
  `Dex` int(11) NOT NULL,
  `Con` int(11) NOT NULL,
  `Intel` int(11) NOT NULL,
  `Wis` int(11) NOT NULL,
  `Cha` int(11) NOT NULL,
  `Fte` int(11) NOT NULL,
  `WeaponID` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=876 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Hero`
--

INSERT INTO `Hero` (`ID`, `OwnerID`, `PartyID`, `Name`, `Race`, `Class`, `MaxHP`, `CurrentHP`, `Level`, `CurrentXP`, `LevelUpXP`, `Str`, `Dex`, `Con`, `Intel`, `Wis`, `Cha`, `Fte`, `WeaponID`) VALUES
(726, 145, 0, 'Toremrum Oremace', '1', '1', 8, 8, 2, 90, 375, 16, 11, 13, 13, 9, 18, 12, 5),
(727, 145, 0, 'Toremrum Koboldmace', '1', '1', 8, 8, 2, 97, 385, 9, 15, 12, 14, 7, 13, 15, 5),
(307, 142, 0, 'Maghamli Oremace', '1', '1', 10, 10, 2, 192, 389, 11, 12, 16, 16, 5, 13, 14, 1),
(695, 143, 0, 'Toremrum Merrymaker', '2', '3', 61, 1, 9, 6123, 7777, 16, 14, 20, 13, 18, 9, 15, 1),
(769, 143, 0, 'Hafim Biltkimbilt', '2', '3', 69, 31.8, 9, 6158, 7802, 8, 16, 21, 14, 17, 14, 16, 2),
(736, 146, 0, 'Black Ninja', '1', '1', 100, 100, -1, 675, 5000, 20, 25, 30, 22, 19, 18, 20, 10),
(724, 145, 0, 'Toremrum Koboldmace', '3', '1', 4, 4, 2, 91, 379, 11, 11, 9, 17, 15, 15, 10, 3),
(718, 1, 0, 'Throsgrulim Merrymaker', '2', '1', 12, 12, 3, 865, 865, 14, 14, 14, 13, 12, 8, 10, 4),
(870, 1, 0, 'Bilfrogremo the Spoon', '4', '1', 5, 5, 1, 0, 93, 10, 10, 13, 16, 8, 12, 11, 7),
(765, 143, 0, 'Yunlimthroshafrum Fitgoldfit', '2', '1', 18, 16.6, 5, 1562, 2444, 14, 15, 13, 15, 12, 10, 8, 8),
(704, 1, 0, 'Maghamli Koboldmace', '3', '7', 56, 30.4, 11, 11564, 11564, 18, 18, 16, 17, 13, 12, 17, 6),
(705, 1, 0, 'Yundic Plateforge', '4', '3', 13, 13, 6, 3438, 3438, 13, 19, 9, 9, 12, 18, 14, 4),
(762, 143, 0, 'Grulthrosafim Vonmaker', '2', '3', 58, 33.5, 7, 3502, 4765, 15, 13, 22, 14, 16, 10, 9, 8),
(688, 1, 0, 'Yundic Oremace', '3', '2', 33, 33, 7, 4696, 4696, 15, 19, 16, 12, 13, 10, 12, 1),
(867, 142, 0, 'Mulo the Hat-fearer', '4', '1', 0, 1, 1, 32, 93, 8, 18, 3, 15, 10, 16, 7, 8),
(668, 1, 0, 'Maghamli Oremace', '2', '1', 10, 10, 3, 697, 851, 15, 17, 13, 17, 18, 3, 12, 1),
(742, 1, 0, 'Rondonine Capfoot', '3', '2', 42, 42, 7, 3499, 4737, 16, 15, 15, 14, 14, 9, 12, 6),
(729, 145, 0, 'Yundic Merrymaker', '4', '1', 8, 8, 2, 89, 371, 11, 12, 12, 16, 10, 17, 12, 9),
(677, 1, 0, 'Throsgrulim Oremace', '4', '1', 20, 20, 5, 2035, 2376, 16, 12, 13, 13, 14, 19, 18, 1),
(728, 145, 0, 'Havuck Snowfall', '4', '1', 7, 5.6, 2, 98, 382, 12, 11, 11, 16, 16, 19, 11, 9),
(725, 145, 0, 'Maghamli Oremace', '4', '1', 3, 3, 2, 98, 385, 11, 15, 7, 13, 9, 16, 9, 4),
(723, 145, 0, 'Maghamli Plateforge', '4', '1', 11, 11, 2, 99, 397, 14, 14, 15, 11, 15, 14, 7, 7),
(860, 1, 0, 'Ley Maxranksmison', '1', '1', 6, 5.5, 1, 96, 96, 15, 15, 14, 9, 13, 16, 13, 2),
(846, 141, 0, 'Donhasdon Plum', '3', '1', 10, 4, 3, 385, 871, 11, 20, 14, 19, 7, 15, 11, 7),
(711, 1, 0, 'Havuck Oremace', '1', '1', 17, 11, 3, 505, 851, 14, 11, 15, 9, 12, 12, 15, 8),
(791, 1, 0, 'Jaxrim Annerobe', '1', '1', 17, 17, 3, 479, 814, 14, 15, 15, 12, 13, 13, 22, 1),
(722, 145, 0, 'Yundic Plateforge', '2', '1', 13, 7, 2, 384, 384, 10, 14, 17, 15, 13, 9, 11, 7),
(715, 143, 0, 'Havuck Oremace', '2', '2', 35, 27.4, 6, 3153, 3398, 12, 12, 16, 15, 13, 15, 21, 5),
(784, 148, 0, 'Yunhafim Margoldkim', '2', '1', 12, 12, 3, 512, 872, 10, 14, 15, 14, 19, 13, 8, 1),
(766, 143, 0, 'Rybilo the Sword', '4', '1', 14, 13, 4, 856, 1537, 14, 11, 13, 11, 14, 15, 13, 7),
(763, 143, 0, 'Petrilstef ', '1', '1', 15, 13, 3, 763, 858, 13, 12, 15, 15, 12, 12, 12, 2),
(771, 143, 0, 'Mophasjon Treecapmel', '3', '1', 19, 4, 5, 2425, 2425, 16, 18, 12, 19, 10, 9, 10, 3),
(777, 144, 0, 'Frobilo the Fly', '4', '7', 112, 112, 20, 38487, 38487, 16, 21, 16, 15, 19, 17, 16, 3),
(778, 144, 0, 'Jimthrosgrulbeard Biltmarkimace', '2', '1', 33, 33, 5, 2434, 2434, 13, 14, 19, 14, 15, 10, 9, 5),
(869, 142, 0, 'Yunafbeard Fitgold', '2', '1', 4, 1.5, 1, 0, 93, 15, 14, 10, 11, 11, 13, 9, 2),
(796, 143, 0, 'Ronmopdonine Tree', '3', '1', 8, 2.8, 3, 762, 849, 15, 19, 11, 9, 11, 12, 17, 6),
(785, 148, 0, 'Erpetrum Frankithrobson', '1', '1', 4, 4, 2, 387, 387, 10, 17, 8, 15, 9, 18, 14, 4),
(786, 148, 0, 'Dix Vonfitkim', '2', '5', 161, 161, 20, 38870, 38870, 21, 18, 20, 14, 17, 13, 11, 5),
(787, 148, 0, 'Icobim Cobebertson', '1', '1', 12, 12, 3, 852, 852, 15, 14, 10, 10, 15, 10, 14, 2),
(788, 148, 0, 'Yunhafafof Von biltmar', '2', '3', 66, 55.2, 9, 7731, 7731, 14, 15, 20, 11, 15, 15, 15, 5),
(838, 144, 0, 'Limthrosbeard Goldvon', '2', '1', 16, 16, 2, 388, 388, 13, 12, 19, 16, 17, 10, 12, 6),
(793, 148, 0, 'Gremo the Wolf', '4', '1', 12, 0, 4, 1532, 1532, 11, 20, 12, 8, 15, 19, 15, 4),
(794, 148, 0, 'Saint-leycobmet Smi', '1', '1', 8, 8, 2, 360, 360, 13, 9, 12, 14, 11, 12, 18, 9),
(795, 148, 0, 'Bero the Mead-worthy', '4', '1', 24, 24, 5, 2412, 2412, 14, 15, 14, 12, 15, 14, 14, 1),
(873, 143, 0, 'Jim Von bilt', '2', '1', 7, 7, 2, 246, 376, 15, 17, 12, 15, 18, 11, 13, 7),
(857, 141, 0, 'Jimlimaf Margraf', '2', '1', 24, 8.6, 4, 1429, 1525, 11, 11, 18, 13, 15, 11, 18, 9),
(849, 141, 0, 'Leyfaner Freerobsmibertson', '1', '1', 13, 11.5, 2, 164, 386, 12, 12, 17, 12, 17, 11, 13, 7),
(850, 141, 0, 'Dixafgrul Gold', '2', '1', 8, 3.5, 1, 92, 93, 14, 12, 19, 11, 13, 8, 13, 8),
(858, 141, 0, 'Peron Lightplumcapfoot', '3', '1', 4, 1.5, 1, 63, 87, 14, 11, 10, 15, 13, 16, 15, 7),
(852, 141, 0, 'Capdon Fartsky', '3', '1', 5, 1.8, 1, 61, 89, 17, 13, 13, 16, 14, 14, 11, 6),
(853, 141, 0, 'Ryfro the Mead', '4', '1', 11, 8, 2, 154, 381, 13, 13, 16, 14, 12, 14, 11, 7),
(854, 141, 0, 'Limdiximrum Vonfit', '2', '1', 14, 5.4, 2, 123, 376, 15, 6, 18, 15, 7, 10, 15, 3),
(855, 141, 0, 'Yunhafim Gravitgraf', '2', '1', 8, 4.5, 1, 0, 96, 13, 7, 19, 18, 8, 7, 15, 8),
(862, 1, 0, 'Cob Anne', '1', '1', 3, 1.4, 1, 0, 97, 11, 13, 8, 11, 8, 15, 15, 5),
(863, 1, 0, 'Hasperon Melfartplumtrot', '3', '1', 10, 10, 2, 380, 380, 11, 14, 16, 10, 10, 12, 13, 2),
(812, 144, 0, 'Bilo the Badger-worthy', '4', '1', 30, 21, 5, 2354, 2354, 14, 17, 16, 15, 17, 19, 19, 8),
(839, 144, 0, 'Afic Kimace', '2', '1', 18, 18, 3, 865, 865, 11, 14, 16, 14, 15, 11, 16, 9),
(840, 144, 0, 'Yunthros Grafvongrafmace', '2', '1', 7, 7, 2, 373, 373, 16, 12, 10, 12, 14, 11, 13, 6),
(815, 144, 0, 'Yundixet Graf', '2', '1', 15, -2, 3, 873, 873, 16, 9, 14, 9, 13, 11, 16, 1),
(875, 145, 0, 'Fro the Hobbit', '4', '1', 6, 1.6, 1, 29, 92, 11, 16, 14, 15, 13, 9, 8, 7),
(874, 145, 0, 'Bermilo the Spoon', '4', '1', 8, 6, 1, 30, 89, 13, 9, 18, 14, 16, 10, 14, 5),
(872, 142, 0, 'Yungruljimbeard Biltgoldmace', '2', '1', 4, 1.1, 1, 30, 95, 12, 14, 11, 13, 16, 11, 14, 6),
(871, 142, 0, 'Yunhafafdix Biltmarmaker', '2', '1', 5, 1.6, 1, 65, 89, 12, 17, 12, 9, 18, 10, 14, 7),
(841, 144, 0, 'Bero the Spoon-drinker', '4', '1', 8, 8, 2, 391, 391, 7, 15, 12, 10, 14, 18, 15, 8),
(861, 1, 0, 'Don Cap', '3', '1', 3, 3, 2, 89, 374, 13, 12, 7, 15, 14, 14, 12, 4),
(843, 144, 0, 'Yunlimaf Kimvonforge', '2', '1', 14, 14, 2, 368, 368, 17, 9, 18, 11, 9, 10, 15, 1),
(868, 1, 0, 'Flihasflipon Lightplumsky', '3', '1', 4, 4, 1, 32, 95, 14, 16, 11, 17, 16, 6, 7, 1),
(865, 1, 0, 'Jonrilmer Freerson', '1', '1', 6, 1, 1, 29, 99, 15, 10, 14, 15, 16, 14, 16, 7),
(856, 141, 0, 'Dixhrosic Vonmar', '2', '1', 25, 20.1, 4, 1162, 1546, 9, 16, 16, 12, 18, 14, 14, 8);

-- --------------------------------------------------------

--
-- Table structure for table `Race`
--

CREATE TABLE IF NOT EXISTS `Race` (
  `ID` int(11) NOT NULL,
  `Name` text COLLATE utf8_unicode_ci NOT NULL,
  `StrBon` int(11) NOT NULL DEFAULT '0',
  `DexBon` int(11) NOT NULL DEFAULT '0',
  `ConBon` int(11) NOT NULL DEFAULT '0',
  `IntelBon` int(11) NOT NULL DEFAULT '0',
  `WisBon` int(11) NOT NULL DEFAULT '0',
  `ChaBon` int(11) NOT NULL DEFAULT '0',
  `FteBon` int(11) NOT NULL DEFAULT '0',
  `OldAge` int(11) NOT NULL,
  `Description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Race`
--

INSERT INTO `Race` (`ID`, `Name`, `StrBon`, `DexBon`, `ConBon`, `IntelBon`, `WisBon`, `ChaBon`, `FteBon`, `OldAge`, `Description`) VALUES
(1, 'Human', 0, 0, 0, 0, 0, 0, 2, 70, 'Humans are common'),
(2, 'Dwarf', 0, 0, 2, 0, 2, -2, 0, 140, 'Dwarfs live underground'),
(3, 'Elf', 0, 2, -2, 2, 0, 0, 0, 250, 'Elves live a long time'),
(4, 'Halfling', -2, 2, 0, 0, 0, 2, 0, 100, 'Halflings are...small');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `ID` int(11) NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `salt` bigint(20) unsigned NOT NULL DEFAULT '0',
  `gold` int(10) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=149 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`ID`, `username`, `email`, `password`, `salt`, `gold`, `active`) VALUES
(1, 'user', '', 'pass', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Weapon`
--

CREATE TABLE IF NOT EXISTS `Weapon` (
  `ID` int(11) NOT NULL,
  `Name` text COLLATE utf8_unicode_ci NOT NULL,
  `DamageDie` int(11) NOT NULL,
  `DamageQuantity` int(11) NOT NULL,
  `DamageOffset` int(11) NOT NULL,
  `CritChance` int(11) NOT NULL,
  `DamageAttribute` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Weapon`
--

INSERT INTO `Weapon` (`ID`, `Name`, `DamageDie`, `DamageQuantity`, `DamageOffset`, `CritChance`, `DamageAttribute`) VALUES
(1, 'Short Sword', 6, 1, 1, 4, 'Str'),
(2, 'Sharp Short Sword', 6, 1, 2, 4, 'Str'),
(3, 'Blunt Short Sword', 6, 1, 0, 4, 'Str'),
(4, 'Long Sword', 8, 1, 1, 4, 'Str'),
(5, 'Sharp Long Sword', 8, 1, 2, 4, 'Str'),
(6, 'Blunt Long Sword', 8, 1, 0, 4, 'Str'),
(7, 'Dagger', 4, 1, 1, 4, 'Str'),
(8, 'Bow', 6, 1, 1, 4, 'Dex'),
(9, 'Crossbow', 8, 1, 1, 4, 'Dex'),
(10, 'Ninja Strike', 10, 4, 3, 15, 'Dex');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `AdvClass`
--
ALTER TABLE `AdvClass`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Hero`
--
ALTER TABLE `Hero`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `Race`
--
ALTER TABLE `Race`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Weapon`
--
ALTER TABLE `Weapon`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `AdvClass`
--
ALTER TABLE `AdvClass`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `Hero`
--
ALTER TABLE `Hero`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=876;
--
-- AUTO_INCREMENT for table `Race`
--
ALTER TABLE `Race`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=149;
--
-- AUTO_INCREMENT for table `Weapon`
--
ALTER TABLE `Weapon`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
