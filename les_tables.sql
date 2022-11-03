CREATE TABLE utilisateurs (
	ID int NOT NULL AUTO_INCREMENT,
	prenom varchar(30),
	nom varchar(30),
	mail varchar(50),
	mot_de_passe varchar(30),
    administrateur bit, 
    PRIMARY KEY (ID)
)