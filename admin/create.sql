-- MySql
DROP TABLE User;
DROP TABLE Activity;
DROP TABLE Day;

CREATE TABLE User (
  IdU           INT NOT NULL AUTO_INCREMENT, -- max 10 user
  NomU          VARCHAR(40),
  PrenomU       VARCHAR(40),
  LoginU        VARCHAR(40),
  PasswordHashU VARCHAR(40), -- SHA-1 hash
  PRIMARY KEY (IdU)
);

CREATE TABLE Activity (
  IdA    INT NOT NULL,
  NomA   VARCHAR(40),
  DureeA INT,
  PRIMARY KEY (IdA)
);

CREATE TABLE Day (
  DateD DATE NOT NULL,
  IdU   INT,
  IdA   INT,
  PRIMARY KEY (DateD)
);