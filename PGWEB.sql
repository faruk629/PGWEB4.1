DROP DATABASE IF EXISTS inscriptionScolaire; 
CREATE DATABASE inscriptionScolaire;
USE inscriptionScolaire;

CREATE TABLE anneeEtude (
	idAnneeEtude int(3) AUTO_INCREMENT,
	acronyme VARCHAR(3),
	libelle VARCHAR(45),
	CONSTRAINT pk_anneeEtude PRIMARY KEY(idAnneeEtude)
);

CREATE TABLE eleve (
	idEleve int(3) AUTO_INCREMENT,
	nom VARCHAR(45) NOT NULL,
	prenom VARCHAR(45) NOT NULL,
	sexe VARCHAR(3) NOT NULL,
	nRegistreNational VARCHAR(11) NOT NULL,
	dateNaissance VARCHAR(45),
	rue VARCHAR(60) NOT NULL,
	nrue VARCHAR(6) NOT NULL,
	codePostal VARCHAR(4) NOT NULL,
	ville VARCHAR(25) NOT NULL, 
	anneeEtude INT(3) NOT NULL,
	dateCreation VARCHAR(45) NOT NULL, 
	CONSTRAINT pk_eleve PRIMARY KEY(idEleve),
	CONSTRAINT un_eleve UNIQUE (nRegistreNational),
	CONSTRAINT fk_eleve_anneeEtude FOREIGN KEY (anneeEtude) REFERENCES anneeEtude(idAnneeEtude)
);


CREATE TABLE tuteur (
	idTuteur int(3) AUTO_INCREMENT,
	nom VARCHAR(45) NOT NULL,
	prenom VARCHAR(45) NOT NULL,
	sexe VARCHAR(45) NOT NULL,
	nRegistreNational VARCHAR(11) NOT NULL,
	email VARCHAR(70) NOT NULL, 
	mobile varchar(10) NOT NULL,
	telephone varchar(9),
	dateCreation VARCHAR(45) NOT NULL, 
	CONSTRAINT pk_tuteur PRIMARY KEY(idTuteur),
	CONSTRAINT un_tuteur UNIQUE (nRegistreNational),
	CONSTRAINT un_tuteur_email UNIQUE(email)
);

CREATE TABLE eleveHasTuteur (
  idEleveHasTuteur int(3) AUTO_INCREMENT,
	idEleve int(3),
	idTuteur int(3),
	idLienDeParente VARCHAR(25) NOT NULL,
	CONSTRAINT pk_eleveHastuteur PRIMARY KEY (idEleveHasTuteur,idEleve, idTuteur),
	CONSTRAINT fk_eleveHastuteur_tuteur FOREIGN KEY (idTuteur) REFERENCES tuteur (idTuteur),
	CONSTRAINT fk_eleveHastuteur_eleve FOREIGN KEY (idEleve) REFERENCES eleve (idEleve)
);

INSERT INTO anneeEtude VALUES(null,"1A","1ère primaire");
INSERT INTO anneeEtude VALUES(null,"2A","2ème primaire");
INSERT INTO anneeEtude VALUES(null,"3A","3ème primaire");
INSERT INTO anneeEtude VALUES(null,"4A","4ème primaire");
INSERT INTO anneeEtude VALUES(null,"5A","5ème primaire");
INSERT INTO anneeEtude VALUES(null,"6A","6ème primaire");



