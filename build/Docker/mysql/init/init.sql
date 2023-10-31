CREATE DATABASE bbs;

CREATE TABLE bbs.post( 
    title TEXT,
    date DATETIME,
    name TEXT,
    body TEXT
) ENGINE = InnoDB;