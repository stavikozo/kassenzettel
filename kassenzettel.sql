drop database IF EXISTS kassenzettel;
create database kassenzettel;
use kassenzettel;

CREATE TABLE kassenzettel (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        datumUhr DATETIME
);

CREATE TABLE produkte (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          name VARCHAR(255),
                          preis DECIMAL(10, 2),
                          MwSt DECIMAL(5, 2)
);

CREATE TABLE kassenzettelProdukte (
                                      zettelId INT,
                                      produktId INT,
                                      anzahl INT,
                                      FOREIGN KEY (zettelId) REFERENCES zettel(Id),
                                      FOREIGN KEY (produktId) REFERENCES produkte(Id),
                                      PRIMARY KEY (zettelId, produktId)
);

-- Insert 10  Produkte
INSERT INTO produkte (name, preis, MwSt) VALUES
                                         ('Apfel', 10.99, 0.19),
                                         ('Milch', 1.50, 0.19),
                                         ('Brot', 2.75, 0.07),
                                         ('Reis', 3.99, 0.19),
                                         ('Kartoffeln', 5.49, 0.19),
                                         ('Eier', 3.99, 0.07),
                                         ('Vodka', 20.00, 0.19),
                                         ('Orangensaft', 6.25, 0.07),
                                         ('Tomaten', 14.75, 0.19),
                                         ('Hähnchenbrust', 9.99, 0.19);