
-- DATABASE SETUP

CREATE DATABASE IF NOT EXISTS winterclothdistribution;
USE winterclothdistribution;


-- ADMIN TABLE

CREATE TABLE Admin (
    staff_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(100) NOT NULL,
    phone VARCHAR(20)
);


-- DONOR TABLE

CREATE TABLE Donor (
    donor_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(150) UNIQUE,
    password VARCHAR(100),
    phone VARCHAR(20)
);


-- RECIPIENT TABLE

CREATE TABLE Recipient (
    recipient_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(150),
    phone VARCHAR(20)
);


-- CLOTH TABLE

CREATE TABLE Cloth (
    cloth_id INT AUTO_INCREMENT PRIMARY KEY,
    cloth_name VARCHAR(100) NOT NULL,
    type VARCHAR(50),
    size VARCHAR(20),
    quantity INT NOT NULL CHECK (quantity >= 0)
);


-- REQUEST TABLE

CREATE TABLE Request (
    request_id INT AUTO_INCREMENT PRIMARY KEY,
    cloth_id INT,
    recipient_id INT,
    status ENUM('Pending','Approved','Rejected') DEFAULT 'Pending',
    FOREIGN KEY (cloth_id) REFERENCES Cloth(cloth_id) ON DELETE CASCADE,
    FOREIGN KEY (recipient_id) REFERENCES Recipient(recipient_id) ON DELETE CASCADE
);


-- DISTRIBUTION TABLE

CREATE TABLE Distribution (
    distribution_id INT AUTO_INCREMENT PRIMARY KEY,
    cloth_id INT,
    recipient_id INT,
    quantity INT,
    FOREIGN KEY (cloth_id) REFERENCES Cloth(cloth_id),
    FOREIGN KEY (recipient_id) REFERENCES Recipient(recipient_id)
);


-- SAMPLE DATA


-- ADMIN
INSERT INTO Admin (name, email, password, phone)
VALUES 
('Amin Uz Zaman Patwary', 'aminuzzamanpatwary001@gmail.com', '12345', '01700000000');

-- DONORS
INSERT INTO Donor (name, email, password, phone)
VALUES 
('John Doe', 'john@gmail.com', '1111', '01711111111'),
('Jane Smith', 'jane@gmail.com', '2222', '01722222222');

-- RECIPIENTS
INSERT INTO Recipient (name, email, phone)
VALUES 
('Rahim Uddin', 'rahim@gmail.com', '01811111111'),
('Karim Ali', 'karim@gmail.com', '01822222222');

-- CLOTHS
INSERT INTO Cloth (cloth_name, type, size, quantity)
VALUES 
('Jacket', 'Winter Wear', 'M', 10),
('Sweater', 'Winter Wear', 'L', 15),
('Blanket', 'Heavy', 'L', 20);

-- REQUESTS
INSERT INTO Request (cloth_id, recipient_id, status)
VALUES 
(1, 1, 'Pending'),
(2, 2, 'Approved');

-- DISTRIBUTION
INSERT INTO Distribution (cloth_id, recipient_id, quantity)
VALUES 
(2, 2, 1);