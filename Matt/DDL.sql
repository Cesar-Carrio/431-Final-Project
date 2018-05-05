-- Drop and create the database
drop database if exists ProjectBasketball431;
create database if not exists ProjectBasketball431;

use ProjectBasketball431;


-- Roles table
-- 	Each column after Role has nonzero as true, zero
-- 	as false to represent access to tables
create table Roles(
Role enum('observer', 'user', 'manager') primary key,
Accounts_access tinyint(1),
Teams_access tinyint(1),
Games_access tinyint(1),
Players_access tinyint(1),
Statistics_access tinyint(1),
Roles_access tinyint(1)
);

-- Accounts table
-- 	Role is an enum of 3 possible roles
create table Accounts(
Username varchar(100) not null primary key,
Acc_role enum('observer', 'user', 'manager'),
Email varchar(100),
PassHash varchar(100),
Name_First varchar(100),
Name_Last varchar(100),
foreign key (Acc_role) references Roles(Role)
);

-- Team information table
create table Teams(
ID int(10) unsigned auto_increment primary key,
Team_Name varchar(100),
Team_City varchar(100),
Wins tinyint(2),
Losses tinyint(2)
);

-- Game information table
create table Games(
ID int(10) unsigned auto_increment primary key,
Game_Date date,
Winner int(10) unsigned,
Loser int(10) unsigned,
foreign key (Winner) references Teams(ID),
foreign key (Loser) references Teams(ID)
);

-- Players (and coaches) information table
--	PersonType is an enum that specifies players and coaches
create table Players(
ID int(10) unsigned auto_increment primary key,
TeamID int(10) unsigned not null,
Name_First varchar(100),
Name_Last varchar(150) not null,
Street varchar(250),
City varchar(100),
State varchar(100),
Country varchar(100),
ZipCode char(10) check (ZipCode REGEXP '^(?!0{5})(?!9{5})\\d{5}(-(?!0{4})(?!9{4})\\d{4})?$'),
PersonType enum('Player', 'Coach'),
foreign key (TeamID) references Teams(ID)
);

-- Statistics table for a player's statistics in a particular game
create table Statistics(
ID int(10) unsigned auto_increment primary key,
PlayerID int(10) unsigned not null,
GameID int(10) unsigned not null,
PlayingTimeMin tinyint(2) unsigned default 0 check (PlayingTimeMin between 0 and 40),
PlayingTimeSec tinyint(2) unsigned default 0 check (PlayingTimeSec between 0 and 59),
Points tinyint(3) unsigned default 0,
Assists tinyint(3) unsigned default 0,
Rebounds tinyint(3) unsigned default 0,
foreign key (PlayerID) references Players(ID) on delete cascade,
foreign key (GameID) references Games(ID) on delete cascade
);


-- SENSITIVE INFORMATION:
-- 	Tables: Accounts, Players, Roles

-- NON-SENSITIVE INFORMATION:
-- 	Tables: Games, Teams, Statistics

-- Observer role
--	Permissions to SELECT 
-- 	on Teams, Statistics, Games
drop user if exists '431obs';
grant select 
on ProjectBasketball431.Teams
to '431obs'
identified by 'pawn012';
grant select 
on ProjectBasketball431.Statistics
to '431obs'
identified by 'pawn012';
grant select 
on ProjectBasketball431.Games
to '431obs'
identified by 'pawn012';

-- User role
--	Permissions to INSERT, SELECT, UPDATE, DELETE
-- 	on Statistics, Games, Teams
drop user if exists '431user';
grant insert, select, update, delete
on ProjectBasketball431.Statistics
to '431user'
identified by 'knight890';
grant insert, select, update, delete
on ProjectBasketball431.Games
to '431user'
identified by 'knight890';
grant insert, select, update, delete
on ProjectBasketball431.Teams
to '431user'
identified by 'knight890';

-- Executive manager ('Manager' for short in enum) role
-- 	Permissions to INSERT, SELECT, UPDATE, DELETE
-- 	on all tables
drop user if exists '431exec';
grant insert, select, update, delete
on ProjectBasketball431.*
to '431exec'
identified by 'rook456';


-- Insert data
-- 	Roles data
insert into Roles (	Role, Accounts_access, Teams_access, Games_access, 
					Players_access, Statistics_access, Roles_access) values
('observer',	0, 1, 1, 0, 1, 0),
('user',		0, 1, 1, 0, 1, 0),
('manager',		1, 1, 1, 1, 1, 1);

-- 	Teams data
insert into Teams (Team_Name, Team_City, Wins, Losses) values
('Falcons', 'Fullerton', 2, 1),
('Aligators', 'Anaheim', 1, 2);

-- 	Players data
insert into Players (TeamID, Name_First, Name_Last, Street, City, State, Country, ZipCode, PersonType) values
(1,	'Alex', 	'Ackerman', '482 Gold Lane', 		'Fullerton', 	'CA', 'USA', '92834', 'Player'),
(1, 'Ben', 		'Banner', 	'268 Red Street', 		'Fullerton', 	'CA', 'USA', '92834', 'Player'),
(1, 'Cam', 		'Christy', 	'620 Magenta Way', 		'Fullerton', 	'CA', 'USA', '92834', 'Player'),
(1, 'Daniel', 	'Dent', 	'268 White Circle', 	'Fullerton', 	'CA', 'USA', '92834', 'Player'),
(1, 'Edgar', 	'Elton', 	'268 Marigold Park', 	'Fullerton', 	'CA', 'USA', '92834', 'Player'),
(2, 'Cameron', 	'Carson', 	'649 Blue Circle', 		'Anaheim', 	'CA', 'USA', '92899', 'Player'),
(2,	'Nico',		'Robin', 	'184 Green Drive',		'Anaheim', 	'CA', 'USA', '92899', 'Player'),
(2,	'Tony',		'Chopper', 	'491 Brown Avenue',		'Anaheim', 	'CA', 'USA', '92899', 'Player'),
(2,	'Sanji',	'Vinsmoke', '330 Pink Street',		'Anaheim', 	'CA', 'USA', '92899', 'Player'),
(2,	'Silvers',	'Rayleigh', '148 Rainbow Road',		'Anaheim', 	'CA', 'USA', '92899', 'Player'),
(1, 'James', 	'Jones', 	'942 Purple Avenue',	'Fullerton', 	'CA', 'USA', '92834', 'Coach'),
(2, 'David', 	'Drekker', 	'649 Yellow Way',		'Anaheim',		'CA', 'USA', '92899', 'Coach');

-- 	Games data
insert into Games (Game_Date, Winner, Loser) values
('2018-01-15', 1, 2),
('2018-02-12', 2, 1);

-- 	Statistics data
insert into Statistics (PlayerID, GameID, PlayingTimeMin, PlayingTimeSec, Points, Assists, Rebounds) values
(1,	1, 20, 33, 14, 4, 6),
(2,	1, 14, 21, 12, 2, 4);


