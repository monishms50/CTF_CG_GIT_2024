-- Create database
CREATE DATABASE ctf_webapp;

-- Switch to the newly created database
USE ctf_webapp;

-- Table for storing user data
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample users (Rob and Admin)
INSERT INTO users (username, password, role) VALUES ('rob', 'password', 'user');
INSERT INTO users (username, password, role) VALUES ('admin', 'alpha123', 'admin');

-- Table for storing flags
CREATE TABLE flags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    flag_name VARCHAR(255) NOT NULL,
    flag_value VARCHAR(255) NOT NULL,
    unlocked_by INT,
    FOREIGN KEY (unlocked_by) REFERENCES users(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample flags for tasks and final flag
INSERT INTO flags (flag_name, flag_value) VALUES ('flag1', 'FLAG_1_VALUE:127663820373JDBWH3');
INSERT INTO flags (flag_name, flag_value) VALUES ('flag2', 'FLAG_2_VALUE:3EBD773E773738SBB8');
INSERT INTO flags (flag_name, flag_value) VALUES ('flag3', 'FLAG_3_VALUE:3UEBEYY3WBS88EB888');
INSERT INTO flags (flag_name, flag_value) VALUES ('final_flag', 'FINAL_FLAG_VALUE:WBEU3B3373733E');

