CREATE DATABASE boba_database

USE boba_database


CREATE TABLE Admin (
    admin_id int primary key,
    admin_name varchar(50)
);
INSERT INTO Admin VALUES
(1, 'Kelly'),
(2, 'Becca');

CREATE TABLE Base (
    base_id int primary key,
    flavor varchar(50)
);

INSERT INTO Base VALUES
(3, 'Green Tea'),
(4, 'Black Tea'),
(5, 'Jasmine Tea'),
(6, 'Strawberry'),
(7, 'Lychee'),
(8, 'Matcha'),
(9, 'Taro'),
(10, 'Passionfruit'),
(11, 'Brown Sugar'),
(12, 'Mango');

ALTER TABLE Base MODIFY base_id INT AUTO_INCREMENT;


CREATE TABLE Topping (
    topping_id int primary key,
    toppings varchar(50),
    additional_price float
);

INSERT INTO Topping VALUES
(13, 'Tapioca', 0),
(14, 'Mango Popping', 0.55),
(15, 'Strawberry Popping', 0.55),
(16, 'Mini Pearls', 0.35),
(17, 'Lychee jelly', 0.85),
(18, 'Pudding', 0.45);

ALTER TABLE Topping MODIFY topping_id INT AUTO_INCREMENT;

CREATE TABLE Size (
    size_id int primary key,
    sizes varchar(50),
    size_price float
);

INSERT INTO Size VALUES
(19, 'Small', 5.00),
(20, 'Medium', 6.00),
(21, 'Large', 7.00);

ALTER TABLE Size MODIFY size_id INT AUTO_INCREMENT;

