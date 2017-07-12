DROP TABLE IF EXISTS genre;
CREATE TABLE genre (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100)
);
INSERT INTO genre (name) VALUES ('Hip-Hop');
INSERT INTO genre (name) VALUES ('Soul');
INSERT INTO genre (name) VALUES ('Funk');
INSERT INTO genre (name) VALUES ('Choral');
INSERT INTO genre (name) VALUES ('Pop');
INSERT INTO genre (name) VALUES ('Rock');
INSERT INTO genre (name) VALUES ('Indie');

DROP TABLE IF EXISTS record_label;
CREATE TABLE record_label (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100)
);
INSERT INTO record_label (name) VALUES ('Universal Music Group');
INSERT INTO record_label (name) VALUES ('Sony Music');
INSERT INTO record_label (name) VALUES ('Warner Music Group');
INSERT INTO record_label (name) VALUES ('BMG');
INSERT INTO record_label (name) VALUES ('Decca');
INSERT INTO record_label (name) VALUES ('XL Recordings');
INSERT INTO record_label (name) VALUES ('Columbia Records');
INSERT INTO record_label (name) VALUES ('Interscope Records');
INSERT INTO record_label (name) VALUES ('Eleven');

DROP TABLE IF EXISTS album;
CREATE TABLE album (
    id SERIAL PRIMARY KEY,
    artist VARCHAR(100) NOT NULL,
    title VARCHAR(100) NOT NULL,
    genre INTEGER REFERENCES genre(id),
    record_label INTEGER REFERENCES record_label(id),
    pre_release VARCHAR(10) CHECK (pre_release IN ('yes', 'no'))
);
INSERT INTO album (artist, title, genre, record_label, pre_release)
VALUES ('The Military Wives', 'In My Dreams',
    (SELECT id FROM genre WHERE name = 'Choral'),
    (SELECT id FROM record_label WHERE name = 'Decca'), 'yes');

INSERT INTO album (artist, title, genre, record_label, pre_release)
VALUES ('Adele', '21',
    (SELECT id FROM genre WHERE name = 'Pop'),
    (SELECT id FROM record_label WHERE name = 'XL Recordings'), 'no');

INSERT INTO album (artist, title, genre, record_label, pre_release)
VALUES ('Bruce Springsteen', 'Wrecking Ball (Deluxe)',
    (SELECT id FROM genre WHERE name = 'Rock'),
    (SELECT id FROM record_label WHERE name = 'Columbia Records'), 'no');

INSERT INTO album (artist, title, genre, record_label, pre_release)
VALUES ('Lana Del Rey', 'Born To Die',
    (SELECT id FROM genre WHERE name = 'Pop'),
    (SELECT id FROM record_label WHERE name = 'Interscope Records'), 'no');

INSERT INTO album (artist, title, genre, record_label, pre_release)
VALUES ('Gotye', 'Making Mirrors',
    (SELECT id FROM genre WHERE name = 'Indie'),
    (SELECT id FROM record_label WHERE name = 'Eleven'), 'no');
