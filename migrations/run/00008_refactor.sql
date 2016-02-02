UPDATE `weaponbase` SET `ID` = '5' WHERE `name` = 'Mace';
UPDATE `weaponbase` SET `ID` = '6' WHERE `name` = 'Longbow';
UPDATE `weaponbase` SET `ID` = '7' WHERE `name` = 'Rod';
UPDATE `weaponbase` SET `ID` = '8' WHERE `name` = 'Quarterstaff';

ALTER TABLE `weaponbase`
  ADD UNIQUE KEY `ID` (`ID`);

ALTER TABLE `weaponbase`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;