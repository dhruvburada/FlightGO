-- create table airlines

CREATE TABLE airlines (
    id INT AUTO_INCREMENT PRIMARY KEY,
    airline VARCHAR(255) NOT NULL,
    seats INT NOT NULL
);

INSERT INTO airlines (airline, seats) VALUES 
('Air India', 150),
('AirAsia', 150),
('Avelo', 200),
('GoAir', 200),
('Indigo', 220),
('SpiceJet', 180),
('Vistara', 180);

-- ALter flight table by adding 'Issue' and 'Status'

ALTER TABLE Flight 
ADD Status VARCHAR(255),
ADD Issue VARCHAR(255);