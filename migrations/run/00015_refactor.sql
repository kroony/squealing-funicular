ALTER TABLE `User` ADD `kills` INT NOT NULL ;


UPDATE `User`,( SELECT OwnerID, sum(`Kills`) as mysum
                   FROM Hero GROUP BY OwnerID) as s
   SET `User`.`kills` = s.mysum
  WHERE User.ID = s.OwnerID;