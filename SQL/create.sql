DROP TABLE IF EXISTS Customer;
CREATE TABLE `Customer` (
  `userName` varchar (100) NOT NULL,
  `passwd` varchar (100) NOT NULL,
  `name` varchar (100) DEFAULT NULL,
  `phone` varchar (100) DEFAULT NULL,
  `address` varchar (1000) DEFAULT NULL,
  `reservations` varchar (1000) DEFAULT NULL,
  PRIMARY KEY (`userName`)
);
INSERT INTO
  Customer (`userName`, `passwd`)
VALUES
  ('administration', 'administration');
DROP TABLE IF EXISTS Hotel;
CREATE TABLE `Hotel` (
    `location` varchar (100) NOT NULL,
    `availRm` varchar (100) NOT NULL,
    `totalRm` varchar (100) DEFAULT NULL,
    `reservedRm` varchar (100) DEFAULT NULL,
    PRIMARY KEY (`location`)
  );
DROP TABLE IF EXISTS Reservation;
CREATE TABLE Reservation (
    `hotelName` varchar (100) NOT NULL,
    `roomNo` varchar (100) NOT NULL,
    `location` varchar (100) NOT NULL,
    `price` varchar (100) DEFAULT NULL,
    `date` varchar (1000) DEFAULT NULL,
    PRIMARY KEY (`roomNo`)
  );
CREATE TABLE admin (
    ID INT NOT NULL AUTO_INCREMENT,
    name varchar (20),
    email VARCHAR (20),
    password VARCHAR (20),
    PRIMARY KEY (ID)
  );
create table hotel (
  hotelID int not null AUTO_INCREMENT,
  hotelName varchar(30),
  number_of_rooms int,
  Standard int,
  Queen int,
  King int,
  weekendSurge int,
  PRIMARY KEY (hotelID)
);

create table reservation(
  ReservationID int not null AUTO_INCREMENT,
  hotelID int,
  hotelName varchar(50),
  roomType varchar(10),
  email varchar(30),
  arrivalDate date,
  departureDate date,
  totalPrice double,
  numRoom int,
  cancel bool,
  primary key (ReservationID)
);