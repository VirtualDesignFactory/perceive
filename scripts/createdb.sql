#
# Database creation script for percieve
#
# Creates all needed tables and feilds
# to run the web based application
#
# (c) copyright - Virtual Design Factory
#            --- 2015 ---
#

#### IF a database exists, drop it first

DROP DATABASE IF EXISTS perceive;

#### create database and grant permissions to a web user

CREATE DATABASE perceive;
GRANT ALL ON perceive.* TO 'perceive-webuser' IDENTIFIED BY 'per123-web456-user789';
USE perceive;



#### begin table creation

CREATE TABLE company_info (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(50),
slogan VARCHAR(100),
street1 VARCHAR(50),
street2 VARCHAR(50),
city VARCHAR(50),
state VARCHAR(50)
);


CREATE TABLE user (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(50),
password VARCHAR(40),
user_level INT DEFAULT 0
);

CREATE TABLE customer (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(50),
contact VARCHAR(50),
phone VARCHAR(50),
email VARCHAR(100)
);

CREATE TABLE record (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
customer INT,
active BOOL,
time_stamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
created_by INT,
rank INT,
comment TEXT,
link VARCHAR(50),
FOREIGN KEY (customer) REFERENCES customer(id) ON DELETE CASCADE,
FOREIGN KEY (created_by) REFERENCES user(id) ON DELETE SET NULL
);




### Test data -> Values to insert into the database


INSERT INTO company_info (name, slogan, street1, street2, city, state) VALUES (
"Your Company",
"Your Slogan",
"Street address 1",
"Street address 2",
"Your city",
"Your state");


INSERT INTO user (username, password, user_level) VALUES (
"admin",
"admin",
5
);

INSERT INTO user (username, password, user_level) VALUES (
"normal",
"normal",
0
);


INSERT INTO customer (name, contact, phone, email) VALUES (
"Bob the builder",
"Bob Buildalot",
"5555-5555",
"bob@thebuilder.com.au"
);

INSERT INTO customer (name, contact, phone, email) VALUES (
"ABC Constructions",
"Barry Smith",
"8888-88888",
"barry.smith@abc.com.au"
);

INSERT INTO customer (name, contact, phone, email) VALUES (
"Consolidated Constructions",
"Sid Vicious",
"9999-9999",
"sid.vicious@consolidated.com.au"
);

INSERT INTO customer (name, contact, phone, email) VALUES (
"Build it Bob",
"Rob Buildalot",
"5554-5554",
"rob@buildit.com.au"
);

INSERT INTO customer (name, contact, phone, email) VALUES (
"Bobbie the buildess",
"Bobbie Buildalot",
"3333-5555",
"bobbie@buildess.com.au"
);

INSERT INTO customer (name, contact, phone, email) VALUES (
"Abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvqx",
"Abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvqx",
"Abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvqx",
"AbcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvqxAbcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvqx"
);




INSERT INTO record (customer, active, time_stamp, created_by, comment, link, rank) VALUES (
1,
1,
NOW(),
1,
"Here you can insert a long comment describing what the customer has asked for.
Just stick to one point for every entry, this way you can easily remove points if you need to.
Try and be as descriptive as possible for the benifit of anyone who is reading the comment later on.",
"document.pdf",
1
);

INSERT INTO record (customer, active, time_stamp, created_by, comment, link, rank) VALUES (
1,
1,
NOW(),
1,
"lots of entries can be made here, comments will word wrap so they can be fully seen by the user.
If straight comments are not enough to convey your message you can always attach a document, we
recommend that you attach documents in PDF format",
"document2.pdf",
2
);

INSERT INTO record (customer, active, time_stamp, created_by, comment, rank) VALUES (
1,
1,
NOW(),
1,
"This record has no attachments...",
3
);
