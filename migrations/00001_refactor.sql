alter table User modify column username varchar(200);
alter table `User` add unique (username);
