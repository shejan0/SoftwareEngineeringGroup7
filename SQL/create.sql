drop table if exists Customer;
CREATE TABLE `Customer` (
  `userName`        varchar(100)    	NOT NULL,
  `passwd`			varchar(100)		NOT NULL,
  `name`            varchar(100) 	DEFAULT NULL,
  `phone`			varchar(100)		DEFAULT NULL,
  `address`			varchar(1000)	DEFAULT NULL,
  `reservations`	varchar(1000)	DEFAULT NULL,
  PRIMARY KEY (`userName`)
);

INSERT INTO Customer(`userName`, `passwd`) VALUES 
	('administration', 'administration'); 
drop table if exists Hotel;
CREATE TABLE `Hotel` (
  `location`        varchar(100)    	NOT NULL,
  `availRm`			varchar(100)		NOT NULL,
  `totalRm`            varchar(100) 	DEFAULT NULL,
  `reservedRm`			varchar(100)		DEFAULT NULL,
  PRIMARY KEY (`location`)
);
drop table if exists Reservation;
CREATE TABLE `Reservation` (
  `hotelName`       varchar(100)    	NOT NULL,
  `roomNo`			varchar(100)		NOT NULL,
  `location`	varchar(100) 		NOT NULL,
  `price`			varchar(100)		DEFAULT NULL,
  `date`			varchar(1000)	DEFAULT NULL,
  PRIMARY KEY (`roomNo`)
);

create table admin(
    ID int not null AUTO_INCREMENT,
    name varchar(20),
    email VARCHAR(20),
    password VARCHAR(20),
    PRIMARY KEY (ID)
);
