/*
Creazione database
*/

DROP DATABASE IF EXISTS unimensa;
CREATE DATABASE unimensa;
USE unimensa;


/*
Creazione tabella registrazione utenti
*/

DROP TABLE IF EXISTS recharge;
DROP TABLE IF EXISTS takeaway;
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
    `name` VARCHAR(40) NOT NULL,
	`surname` VARCHAR(40) NOT NULL,
    email VARCHAR(100) NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    cash FLOAT NOT NULL DEFAULT 0,
    `admin` BIT NOT NULL DEFAULT 0,
    PRIMARY KEY(email)
) ENGINE InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` VALUES
	('Pietro','Francaviglia','p@gmail.com','8bce6fd5c71efdf1bb51b0cd942fdcbf',22.8,1),
    ('Giorgio','Donati','g@gmail.com','4e09fb51b7b7d26fd97fbe6f8aa19738',15,0),
    ('Filippo','Mannino','f@gmail.com','c0dab5351a8eb801383f5796df068946',15,0),
    ('Andrea', 'Vicari', 'a@gmail.com', '7d57eedb36844c7523ac6b00d90fea4f', 15,0);


/*
Creazione tabella mensa
*/

-- necessario per la foreign key
DROP TABLE IF EXISTS menu;
DROP TABLE IF EXISTS mensa;
CREATE TABLE mensa (     
	mensaID INT NOT NULL AUTO_INCREMENT,
    address VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    imgLink VARCHAR(50) DEFAULT "noimg.jpg",
    PRIMARY KEY (mensaID)
) ENGINE InnoDB DEFAULT CHARSET=utf8;

INSERT INTO mensa (address, phone, imgLink) VALUES
	("Via San Lorenzo, 33", "050-123456", "mensa_1.jpg"),
	("Via di Pratale, 12", "050-987654", "mensa_2.jpg");


/*
Creazione tabella menu
*/

DROP TABLE IF EXISTS menu;
CREATE TABLE menu (
	dishID INT NOT NULL AUTO_INCREMENT,
    dishDate DATE NOT NULL,
    dishName VARCHAR(50) NOT NULL,
    mensa INT NOT NULL,
    course INT NOT NULL,
    portions INT NOT NULL,
    veg BOOL NOT NULL DEFAULT 0,
    PRIMARY KEY(dishID),
    UNIQUE(dishDate, dishName, mensa),
    CONSTRAINT mensa_menu_fk FOREIGN KEY (mensa) REFERENCES mensa (mensaID) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE InnoDB DEFAULT CHARSET=utf8;

INSERT INTO menu (dishDate, dishName, mensa, course, portions, veg) VALUES
	('2021-02-03', 'Vellutata di carote', 1, 2, 50, 1),
    ('2021-02-03', 'Pasta alla sorrentina', 1, 2, 50, 1),
    ('2021-02-03', 'Spaghetti allo scoglio', 1, 2, 50, 0),
    ('2021-02-03', 'Saltimbocca alla romana', 1, 3, 50, 0),
    ('2021-02-03', 'Uova con spinaci', 1, 3, 50, 1),
    ('2021-02-03', 'Sformato di porri', 1, 3, 50, 1),
    ('2021-02-03', 'Ceci', 1, 1, 50, 1),
    ('2021-02-03', 'Zucca', 1, 1, 50, 1),
    ('2021-02-03', 'Spinaci cotti', 1, 1, 50, 1),
	('2021-02-04', 'Penne noci e taleggio', 1, 2, 50, 1),
    ('2021-02-04', 'Pasta mari e monti', 1, 2, 50, 0),
    ('2021-02-04', 'Cecina', 1, 2, 50, 1),
    ('2021-02-04', 'Bistecca di maiale', 1, 3, 50, 0),
    ('2021-02-04', 'Sogliola al limone', 1, 3, 50, 0),
    ('2021-02-04', 'Fonduta di formaggi', 1, 3, 50, 0),
    ('2021-02-04', 'Radicchio al forno', 1, 1, 50, 1),
    ('2021-02-04', 'Fagioli', 1, 1, 50, 1),
    ('2021-02-04', 'Insalata fresca', 1, 1, 50, 1),
	('2021-02-03', 'Vellutata di carote', 2, 2, 50, 1),
    ('2021-02-03', 'Pasta alla sorrentina', 2, 2, 50, 1),
    ('2021-02-03', 'Spaghetti allo scoglio', 2, 2, 50, 0),
    ('2021-02-03', 'Saltimbocca alla romana', 2, 3, 50, 0),
    ('2021-02-03', 'Uova con spinaci', 2, 3, 50, 1),
    ('2021-02-03', 'Sformato di porri', 2, 3, 50, 1),
    ('2021-02-03', 'Ceci', 2, 1, 50, 1),
    ('2021-02-03', 'Zucca', 2, 1, 50, 1),
    ('2021-02-03', 'Spinaci cotti', 2, 1, 50, 1),
	('2021-02-04', 'Penne noci e taleggio', 2, 2, 50, 1),
    ('2021-02-04', 'Pasta mari e monti', 2, 2, 50, 0),
    ('2021-02-04', 'Cecina', 2, 2, 50, 1),
    ('2021-02-04', 'Bistecca di maiale', 2, 3, 50, 0),
    ('2021-02-04', 'Sogliola al limone', 2, 3, 50, 0),
    ('2021-02-04', 'Fonduta di formaggi', 2, 3, 50, 1),
    ('2021-02-04', 'Radicchio al forno', 2, 1, 50, 1),
    ('2021-02-04', 'Fagioli', 2, 1, 50, 1),
    ('2021-02-04', 'Insalata fresca', 2, 1, 50, 1),
    ('2021-02-05', 'Pasticcio di cavolfiore', 1, 3, 50, 1),
    ('2021-02-05', 'Parmigiana di patate', 1, 3, 50, 1),
	('2021-02-06', 'Risotto al nero di seppia', 1, 2, 50, 0),
    ('2021-02-06', 'Pasta al pomodoro', 1, 2, 50, 1),
    ('2021-02-06', 'Lasagne alla bolognese', 1, 2, 50, 0),
    ('2021-02-06', 'Platessa alla senape', 1, 3, 50, 0),
    ('2021-02-06', 'Insalata fresca', 2, 1, 50, 1);
    
DROP TABLE IF EXISTS takeaway;
CREATE TABLE takeaway (
	orderID INT NOT NULL AUTO_INCREMENT,
    `user` VARCHAR(100) NOT NULL,
    dish1 INT NOT NULL,
    dish2 INT DEFAULT NULL,
    dish3 INT DEFAULT NULL,
    dish4 INT DEFAULT NULL,
    dish5 INT DEFAULT NULL,
    takeaway_time TIME NOT NULL,
    `time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(orderID),
    UNIQUE(`user`, `time`),
    CONSTRAINT user_order_fk FOREIGN KEY (`user`) REFERENCES `user` (email) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS recharge;
CREATE TABLE recharge (
	rechargeID INT NOT NULL AUTO_INCREMENT,
    `user` VARCHAR(100) NOT NULL,
    money INT NOT NULL,
    PRIMARY KEY(rechargeID),
    CONSTRAINT user_loading_fk FOREIGN KEY (`user`) REFERENCES `user` (email) ON DELETE CASCADE ON UPDATE CASCADE
)  ENGINE InnoDB DEFAULT CHARSET=utf8;

INSERT INTO recharge (`user`, money) VALUES
	('g@gmail.com', 15),
    ('a@gmail.com', 20);