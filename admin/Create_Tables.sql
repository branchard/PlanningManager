#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------
DROP TABLE IF EXISTS Hour;
DROP TABLE IF EXISTS Day;
DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Activity;

CREATE TABLE User (
  IdU           TINYINT      NOT NULL AUTO_INCREMENT,
  NomU          VARCHAR(40),
  PrenomU       VARCHAR(40),
  LoginU        VARCHAR(40)  NOT NULL,
  PasswordHashU VARCHAR(255) NOT NULL,
  PRIMARY KEY (IdU)
)
  ENGINE =InnoDB;


CREATE TABLE Activity (
  IdA  TINYINT     NOT NULL,
  NomA VARCHAR(40) NOT NULL,
  PRIMARY KEY (IdA)
)
  ENGINE =InnoDB;


CREATE TABLE Day (
  IdD   TINYINT NOT NULL AUTO_INCREMENT,
  DateD DATE    NOT NULL,
  IdU   TINYINT NOT NULL,
  PRIMARY KEY (IdD),
  INDEX (DateD)
)
  ENGINE =InnoDB;


CREATE TABLE Hour (
  IdH TINYINT NOT NULL AUTO_INCREMENT,
  NmH TINYINT NOT NULL,
  IdD TINYINT NOT NULL,
  IdA TINYINT NOT NULL,
  PRIMARY KEY (IdH)
)
  ENGINE =InnoDB;

ALTER TABLE Day ADD CONSTRAINT FK_Day_IdU FOREIGN KEY (IdU) REFERENCES User (IdU);
ALTER TABLE Hour ADD CONSTRAINT FK_Hour_IdD FOREIGN KEY (IdD) REFERENCES Day (IdD);
ALTER TABLE Hour ADD CONSTRAINT FK_Hour_IdA FOREIGN KEY (IdA) REFERENCES Activity (IdA);

#------------------------------------------------------------
#        INSERT
#------------------------------------------------------------

-- INSERT INTO Activity VALUES (1, 'Java');
-- INSERT INTO Activity VALUES (2, 'PHP');
-- INSERT INTO Activity VALUES (3, 'Python');
-- INSERT INTO Activity VALUES (4, 'Anglais');
-- INSERT INTO Activity VALUES (5, 'Repos');
-- INSERT INTO Activity VALUES (6, 'Café');
