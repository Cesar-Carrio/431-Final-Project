drop database if exists ProjectBasketball431;
create database if not exists ProjectBasketball431;

use ProjectBasketball431;

create table Accounts(
Username varchar(100) not null primary key,
Email varchar(100),
PassHash varchar(100)
);

create table Teams(
ID int(10) unsigned auto_increment primary key,
Team_Name varchar(100),
Team_City varchar(100),
Wins tinyint(2),
Losses tinyint(2)
);

create table Games(
ID int(10) unsigned auto_increment primary key,
Game_Date date,
Game_Length time,
Winner int(10) unsigned,
Loser int(10) unsigned,
foreign key (Winner) references Teams(ID),
foreign key (Loser) references Teams(ID)
);

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
PersonType varchar(100),
foreign key (TeamID) references Teams(ID)
);

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

