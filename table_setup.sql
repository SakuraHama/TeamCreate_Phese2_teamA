CREATE TABLE user (
    USER_NO int primary key auto_increment,
    UNAME varchar(20) not null,
    PASS varchar(256) not null,
    UNIQUE (PASS)
);

CREATE USER 'dbuser'@'localhost' IDENTIFIED BY 'ecc';

GRANT ALL ON life_step.* 'dbuser'@'localhost';

