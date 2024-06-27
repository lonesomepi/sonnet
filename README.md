/lonesome note
|-- /assets
|   |-- /images
|   |-- /icons
|-- /includes
|-- /scripts
|-- /styles
|-- .env
|-- index.php

-- Create Users Table
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create Items Table
CREATE TABLE items (
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    item VARCHAR(255) NOT NULL,
    category VARCHAR(100),
    media TINYINT(1) DEFAULT 0,
    media_count TINYINT(3) DEFAULT 0,
    user_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Sample user for admin (password should be hashed)
INSERT INTO users (username, password, email, role) VALUES ('alex', 'supratt', 'alex.catalano2@gmail.com', 'admin');