CREATE TABLE users (id int AUTO_INCREMENT,username varchar(20),email varchar(100),password varchar(100),role
varchar(6),date varchar(30),verify varchar(4) DEFAULT 'no', PRIMARY KEY (id));

CREATE TABLE comments (id int AUTO_INCREMENT,name varchar(20),email varchar(100),msg varchar(100),timestamp
varchar(100),likes INT NOT NULL DEFAULT '0' ,dislikes INT NOT NULL DEFAULT '0',PRIMARY KEY (id));

CREATE TABLE chat (id int AUTO_INCREMENT,apo varchar(20),se varchar(20),message varchar(3000),tme varchar(25), PRIMARY
KEY (id));

CREATE TABLE rptokens (rpt_id int AUTO_INCREMENT,rptkn varchar(100),valid varchar(4),expdate varchar(50), PRIMARY KEY
(rpt_id));

CREATE TABLE cld (id int AUTO_INCREMENT,c_id varchar(100),uwl varchar(20),lod varchar(8), PRIMARY KEY(id))