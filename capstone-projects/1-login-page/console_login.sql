CREATE DATABASE login;
USE login;

CREATE TABLE user(
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(256) UNIQUE,
    user_password VARCHAR(256)
);

SELECT * FROM user;

INSERT INTO user(user_name, user_password) VALUES ('francisohara', 'password');
INSERT INTO user(user_name, user_password) VALUES ('nikola', 'tesla');