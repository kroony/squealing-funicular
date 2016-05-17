UPDATE  `troutsla_SF`.`User` SET  `active` =  '1' WHERE  `User`.`ID` =146;

ALTER TABLE  `User` ADD  `refererID` INT NOT NULL AFTER  `active` ;

