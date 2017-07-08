DROP TABLE IF EXISTS album;
CREATE TABLE album (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    artist varchar(100) NOT NULL,
    title varchar(100) NOT NULL,
    genre varchar2(100),
    record_label varchar2(100)
);
--INSERT INTO album (artist, title) VALUES ('The Military Wives', 'In My Dreams');
--INSERT INTO album (artist, title) VALUES ('Adele', '21');
--INSERT INTO album (artist, title) VALUES ('Bruce Springsteen', 'Wrecking Ball (Deluxe)');
--INSERT INTO album (artist, title) VALUES ('Lana Del Rey', 'Born To Die');
--INSERT INTO album (artist, title) VALUES ('Gotye', 'Making Mirrors');

DROP TABLE IF EXISTS genre;
CREATE TABLE genre (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(100)
);

DROP TABLE IF EXISTS record_label;
CREATE TABLE record_label (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(100)
);
