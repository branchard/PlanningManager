
drop table User;
drop table Activity;
drop table Day;

create table User(
IdU number(2) primary key,
NomU varchar2(20),
PrenomU varchar2(20));

create table Activity(
IdA number(2) primary key,
NomA varchar2(20),
DureeA number(1));

create table Day(
DateD date primary key,
IdU number(2),
IdA number(2),
constraint AUser foreign  key (IdU) references User(IdU),
);