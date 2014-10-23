-- MySql
DROP TABLE User;
DROP TABLE Activity;
DROP TABLE Day;
DROP TABLE ActiDay;

CREATE TABLE User (
  IdU           TINYINT(2) NOT NULL AUTO_INCREMENT, -- max 10 user
  NomU          VARCHAR(40),
  PrenomU       VARCHAR(40),
  LoginU        VARCHAR(40),
  PasswordHashU VARCHAR(255),
  PRIMARY KEY (IdU)
);

CREATE TABLE Activity (
  IdA    TINYINT NOT NULL,
  NomA   VARCHAR(40),
  DureeA TINYINT(2),
  PRIMARY KEY (IdA)
);

CREATE TABLE Day (
  DateD DATE NOT NULL,
  PRIMARY KEY (DateD)
);

CREATE TABLE ActiDay (
  IdA TINYINT REFERENCES IdA(Activity),
  DateD DATE REFERENCES DateD(Day)
);

-- alter table ActiDay add(
--   constraint KFINSc.. foreign key (numLicence) REFERENCES JOUEUR (numLicence)
--   );