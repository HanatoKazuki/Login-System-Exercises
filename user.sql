create database login_auth;
use login_auth;
create TABLE users (
id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(75) NOT NULL,
password VARCHAR(200) NOT NULL,
created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)