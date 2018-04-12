drop database if exists ProjectBasketball431;
create database if not exists ProjectBasketball431;

use ProjectBasketball431;

create table Accounts(

);

create table Games(
ID int(10) unsigned auto_increment primary key
);

create table Teams(
ID int(10) unsigned auto_increment primary key
);

create table TeamRoster(
ID int(10) unsigned auto_increment primary key,
TeamID int(10) unsigned not null,
Name_First varchar(100),
Name_Last varchar(150) not null,
Street varchar(250),
City varchar(100),
State varchar(100),
Country varchar(100),
ZipCode char(10) check (ZipCode REGEXP '^(?!0{5})(?!9{5})\\d{5}(-(?!0{4})(?!9{4})\\d{4})?$'),
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
foreign key (PlayerID) references TeamRoster(ID) on delete cascade,
foreign key (GameID) references Games(ID) on delete cascade
);

