CREATE TABLE `Location` (
  `ID` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `description` text NOT NULL,
  `requiredExploration` bigint(20) UNSIGNED NOT NULL,
  `minLevel` tinyint(4) NOT NULL,
  `maxLevel` tinyint(4) NOT NULL,
  `rewardType` tinytext NOT NULL,
  `rewardChance` decimal(10,0) NOT NULL,
  `NPCFightChance` decimal(10,0) NOT NULL,
  `NPCList` tinytext NOT NULL,
  `distance` smallint(5) UNSIGNED NOT NULL,
  `cost` smallint(6) NOT NULL,
  `costChance` decimal(10,0) NOT NULL,
  `linkHidden` tinyint(1) NOT NULL,
  `URL` tinytext NOT NULL,
  `pageName` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `Location`
--
ALTER TABLE `Location`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for table `Location`
--
ALTER TABLE `Location`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
