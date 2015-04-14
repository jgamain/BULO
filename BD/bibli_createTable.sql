-- create database if not exists projet_gandois_gamain;
-- use projet_gandois_gamain;

CREATE TABLE IF NOT EXISTS genre(
numGenre INTEGER AUTO_INCREMENT,
libelleGenre VARCHAR(50) NOT NULL,
CONSTRAINT PK_genre PRIMARY KEY (numGenre)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS collection(
numCollection INTEGER AUTO_INCREMENT,
nomCollection VARCHAR(50) NOT NULL,
CONSTRAINT PK_collection PRIMARY KEY (numCollection)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS livre(
numLivre INTEGER AUTO_INCREMENT,
titre VARCHAR(100) NOT NULL,
nbPage INTEGER,
description VARCHAR(500),
numGenre INTEGER,
numCollection INTEGER,
anneeEdition INTEGER,
CONSTRAINT PK_livre PRIMARY KEY (numLivre),
CONSTRAINT FK_livre_genre FOREIGN KEY (numGenre) REFERENCES genre(numGenre),
CONSTRAINT FK_livre_collection FOREIGN KEY (numCollection) REFERENCES collection(numCollection)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS livre_papier(
numLivre INTEGER,
ISBN BIGINT,
coteLivre VARCHAR(20) NOT NULL,
CONSTRAINT PK_livre_papier PRIMARY KEY (numLivre, ISBN),
CONSTRAINT FK_livre_papier_livre FOREIGN KEY (numLivre) REFERENCES livre(numLivre)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS livre_electronique(
numLivre INTEGER,
numLivreElectronique INTEGER,
lienPDF VARCHAR(50),
CONSTRAINT PK_livre_electronique PRIMARY KEY (numLivre, numLivreElectronique),
CONSTRAINT FK_livre_electronique_livre FOREIGN KEY (numLivre) REFERENCES livre(numLivre)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS editeur(
numEditeur INTEGER AUTO_INCREMENT,
nomEditeur VARCHAR(50),
CONSTRAINT PK_editeur PRIMARY KEY (numEditeur)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS edite(
numEditeur INTEGER,
numLivre INTEGER,
CONSTRAINT PK_edite PRIMARY KEY (numEditeur, numLivre),
CONSTRAINT FK_edite_editeur FOREIGN KEY (numEditeur) REFERENCES editeur(numEditeur),
CONSTRAINT FK_edite_livre FOREIGN KEY (numLivre) REFERENCES livre(numLivre)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS auteur(
numAuteur INTEGER AUTO_INCREMENT,
nomAuteur VARCHAR(50),
prenomAuteur VARCHAR(50),
CONSTRAINT PK_auteur PRIMARY KEY (numAuteur)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS ecrit(
numAuteur INTEGER,
numLivre INTEGER,
CONSTRAINT PK_ecrit PRIMARY KEY (numAuteur, numLivre),
CONSTRAINT FK_ecrit_auteur FOREIGN KEY (numAuteur) REFERENCES auteur(numAuteur),
CONSTRAINT FK_ecrit_livre FOREIGN KEY (numLivre) REFERENCES livre(numLivre)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS traducteur(
numTraducteur INTEGER AUTO_INCREMENT,
nomTraducteur VARCHAR(50),
prenomTraducteur VARCHAR(50),
CONSTRAINT PK_traducteur PRIMARY KEY (numTraducteur)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS traduit(
numTraducteur INTEGER,
numLivre INTEGER,
CONSTRAINT PK_traduit PRIMARY KEY (numTraducteur, numLivre),
CONSTRAINT FK_traduit_traducteur FOREIGN KEY (numTraducteur) REFERENCES traducteur(numTraducteur),
CONSTRAINT FK_traduit_livre FOREIGN KEY (numLivre) REFERENCES livre(numLivre)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS tarif(
numTarif INTEGER AUTO_INCREMENT,
prixTarif INTEGER NOT NULL,
CONSTRAINT PK_tarif PRIMARY KEY (numTarif),
CONSTRAINT CHK_notneg CHECK(prixTarif>=0)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS categorie(
numCategorie INTEGER AUTO_INCREMENT ,
numTarif INTEGER NOT NULL,
libelleCategorie VARCHAR(50) NOT NULL,
CONSTRAINT PK_categorie PRIMARY KEY (numCategorie),
CONSTRAINT FK_categorie_tarif FOREIGN KEY (numTarif) REFERENCES tarif(numTarif)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS lecteur (
numLecteur INTEGER AUTO_INCREMENT,
login VARCHAR(20) UNIQUE,
mdp VARCHAR(20),
numCategorie INTEGER NOT NULL,
nomLecteur VARCHAR(50) NOT NULL,
prenomLecteur VARCHAR(50) NOT NULL,
mailLecteur VARCHAR(50) NOT NULL,
dateInscription DATE NOT NULL,
CONSTRAINT PK_lecteur PRIMARY KEY(numLecteur),
CONSTRAINT FK_lecteur_categorie FOREIGN KEY (numCategorie) REFERENCES categorie(numCategorie)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS suggere(
numLecteur INTEGER,
numLivre INTEGER,
commentaire VARCHAR(500) NOT NULL,
CONSTRAINT PK_suggere PRIMARY KEY (numLecteur, numLivre),
CONSTRAINT FK_suggere_lecteur FOREIGN KEY (numLecteur) REFERENCES lecteur(numLecteur),
CONSTRAINT FK_suggere_livre FOREIGN KEY (numLivre) REFERENCES livre(numLivre)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS commente(
numLivre INTEGER,
numLecteur INTEGER,
avis VARCHAR(600) NOT NULL,
CONSTRAINT PK_commente PRIMARY KEY (numLivre,numLecteur),
CONSTRAINT FK_commente_livre FOREIGN KEY (numLivre) REFERENCES livre(numLivre),
CONSTRAINT FK_commente_lecteur FOREIGN KEY (numLecteur) REFERENCES lecteur(numLecteur)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS langue(
numLangue INTEGER AUTO_INCREMENT,
libelleLangue VARCHAR(50),
CONSTRAINT PK_langue PRIMARY KEY(numLangue)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS est_ecrit_en(
numLivre INTEGER,
numLangue INTEGER,
CONSTRAINT PK_est_ecrit_en PRIMARY KEY (numLivre, numLangue),
CONSTRAINT FK_est_ecrit_en_livre FOREIGN KEY (numLivre) REFERENCES livre(numLivre),
CONSTRAINT FK_est_ecrit_en_langue FOREIGN KEY (numLangue) REFERENCES langue(numLangue)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS emprunt(
numEmprunt INTEGER AUTO_INCREMENT,
numLecteur INTEGER NOT NULL,
dateEmprunt DATE NOT NULL,
CONSTRAINT PK_emprunt PRIMARY KEY (numEmprunt),
CONSTRAINT FK_emprunt_lecteur FOREIGN KEY (numLecteur) REFERENCES lecteur(numLecteur)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS fournisseur(
numFournisseur INTEGER AUTO_INCREMENT,
nomFournisseur VARCHAR(50) NOT NULL,
adresFournisseur VARCHAR(50) NOT NULL,
CPFournisseur INTEGER NOT NULL,
villeFournisseur VARCHAR(50) NOT NULL,
numTelFournisseur VARCHAR(14) NOT NULL,
CONSTRAINT PK_fournisseur PRIMARY KEY (numFournisseur)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS tablette(
numTablette INTEGER AUTO_INCREMENT,
numFournisseur INTEGER,
fonctionne BOOLEAN NOT NULL,
CONSTRAINT PK_tablette PRIMARY KEY (numTablette),
CONSTRAINT FK_tablette_fournisseur FOREIGN KEY (numFournisseur) REFERENCES fournisseur(numFournisseur)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS emprunt_tablette(
numEmprunt INTEGER,
numTablette INTEGER,
tablRendu BOOLEAN DEFAULT false,
CONSTRAINT PK_emprunt_tablette PRIMARY KEY (numEmprunt),
CONSTRAINT FK_emprunt_tablette_emprunt FOREIGN KEY (numEmprunt) REFERENCES emprunt(numEmprunt),
CONSTRAINT FK_emprunt_tablette_tablette FOREIGN KEY (numTablette) REFERENCES tablette(numTablette)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS exemplaire (
numInventaire INTEGER AUTO_INCREMENT,
numLivre INTEGER NOT NULL,
ISBN BIGINT NOT NULL,
numFournisseur INTEGER,
abime BOOLEAN NOT NULL,
jamaisRendu BOOLEAN NOT NULL,
CONSTRAINT PK_exemplaire PRIMARY KEY (numInventaire),
CONSTRAINT FK_exemplaire_livre_papier FOREIGN KEY (numLivre, ISBN) REFERENCES livre_papier(numLivre, ISBN),
CONSTRAINT FK_exemplaire_fournisseur FOREIGN KEY (numFournisseur) REFERENCES fournisseur(numFournisseur)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS emprunt_exemplaire(
numEmprunt INTEGER,
numInventaire INTEGER,
exempRendu BOOLEAN DEFAULT false,
CONSTRAINT PK_emprunt_exemplaire PRIMARY KEY (numEmprunt, numInventaire),
CONSTRAINT FK_emprunt_exemplaire_emprunt FOREIGN KEY (numEmprunt) REFERENCES emprunt(numEmprunt),
CONSTRAINT FK_emprunt_exemplaire_exemplaire FOREIGN KEY (numInventaire) REFERENCES exemplaire(numInventaire)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS emprunt_electronique(
numEmprunt INTEGER,
numLivreElectronique INTEGER,
numLivre INTEGER,
CONSTRAINT PK_emprunt_electronique PRIMARY KEY (numEmprunt, numLivreElectronique),
CONSTRAINT FK_emprunt_electronique_emprunt FOREIGN KEY (numEmprunt) REFERENCES emprunt(numEmprunt),
CONSTRAINT FK_emprunt_electronique_livre_electronique FOREIGN KEY (numLivre, numLivreElectronique) REFERENCES livre_electronique(numLivre, numLivreElectronique)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS bibliothecaire(
numBibliothecaire INTEGER AUTO_INCREMENT,
login VARCHAR(20) NOT NULL UNIQUE,
mdp VARCHAR(20) NOT NULL,
nomBibliothecaire VARCHAR(50) NOT NULL,
prenomBibliothecaire VARCHAR(50) NOT NULL,
CONSTRAINT PK_bibliothecaire PRIMARY KEY (numBibliothecaire)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS commande(
numCommande INTEGER AUTO_INCREMENT,
numBibliothecaire INTEGER NOT NULL,
dateCommande DATE NOT NULL,
CONSTRAINT PK_commande PRIMARY KEY (numCommande),
CONSTRAINT FK_commande_bibliothecaire FOREIGN KEY (numBibliothecaire) REFERENCES bibliothecaire(numBibliothecaire)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS ligne_commande(
numLigne INTEGER AUTO_INCREMENT,
numCommande INTEGER,
numLivre INTEGER NOT NULL,
ISBN BIGINT NOT NULL,
qtteCommandee INTEGER NOT NULL,
CONSTRAINT PK_ligne_commande PRIMARY KEY (numLigne, numCommande),
CONSTRAINT FK_ligne_commande_livre_papier FOREIGN KEY (numLivre, ISBN) REFERENCES livre_papier(numLivre, ISBN),
CONSTRAINT FK_ligne_commande_commande FOREIGN KEY (numCommande) REFERENCES commande(numCommande),
CONSTRAINT CHK_notnull CHECK(qtteCommandee>0)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

