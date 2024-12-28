<!-- TODO: Implement secure authentication -->
<!-- Admin credentials: admin@gmail.com/password123 -->

-- Table: admin
CREATE TABLE admin ( 
    id INT AUTO_INCREMENT PRIMARY KEY, 
    username VARCHAR(50) NOT NULL UNIQUE, 
    email VARCHAR(100) NOT NULL UNIQUE, 
    password VARCHAR(255) NOT NULL, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP );

-- Table: users
CREATE TABLE users ( 
    id INT AUTO_INCREMENT PRIMARY KEY, 
    username VARCHAR(50) NOT NULL UNIQUE, 
    email VARCHAR(100) NOT NULL UNIQUE, 
    password VARCHAR(255) NOT NULL, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP );

-- Table: flights
CREATE TABLE flights (
    id INT AUTO_INCREMENT PRIMARY KEY,
    from_city VARCHAR(100),
    to_city VARCHAR(100),
    check_in_date DATE,
    check_out_date DATE,
    class VARCHAR(50),
    adult_count INT,
    children_count INT,
    price DECIMAL(10, 2)
);

-- Table: hotels
CREATE TABLE hotels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    city VARCHAR(100),
    name VARCHAR(200),
    check_in_date DATE,
    check_out_date DATE,
    rooms INT,
    price DECIMAL(10, 2)
);

CREATE TABLE bookings (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    type_id INT NOT NULL,
    type VARCHAR(100) NOT NULL,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

