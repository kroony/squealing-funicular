CREATE TABLE IF NOT EXISTS `Party` (
  `ID` int(11) NOT NULL,
  `Name` text COLLATE utf8_unicode_ci NOT NULL,
  `Status` int(11) NOT NULL,
  `Cooldown` date NOT NULL,
  `OwnerID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `Party`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `Party`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;