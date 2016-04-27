CREATE TABLE IF NOT EXISTS `Sale` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SellerID` int(11) NOT NULL,
  `ItemType` text NOT NULL,
  `ItemID` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `Created` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;