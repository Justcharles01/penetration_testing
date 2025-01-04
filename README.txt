<!-- TODO: Implement secure authentication -->
<!-- Admin credentials: admin@gmail.com/12345 -->

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

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'admin', 'admin@gmail.com', 'password123', '2024-12-21 09:25:53');

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'tester', 'testing@gmail.com', '12345', '2024-12-17 05:07:52');

INSERT INTO `hotels` (`id`, `city`, `name`, `check_in_date`, `check_out_date`, `rooms`, `price`) VALUES
(1, 'atlanta', 'ATL Home', '2024-12-18', '2025-01-03', 33, 23000.00);

INSERT INTO `flights` (`id`, `from_city`, `to_city`, `check_in_date`, `check_out_date`, `class`, `adult_count`, `children_count`, `price`) VALUES
(2, 'Dubai', 'New York', '2024-12-05', '2025-01-07', 'Business', 26, 6, 45000.00);

INSERT INTO `bookings` (`booking_id`, `type_id`, `type`, `user_id`, `date`) VALUES
(1, 2, 'flight', 1, '2024-12-28 07:31:06'),
(2, 1, 'hotel', 1, '2024-12-28 07:53:07');
