CREATE TABLE IF NOT EXISTS `Message` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ToID` int(11) NOT NULL,
  `FromID` int(11) NOT NULL,
  `Subject` text NOT NULL,
  `Body` text NOT NULL,
  `Sent` datetime NOT NULL,
  `IsRead` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;