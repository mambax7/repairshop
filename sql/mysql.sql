CREATE TABLE garage_clients (
  id               INT(5)       NOT NULL AUTO_INCREMENT,
  compte           VARCHAR(25)  NULL,
  rs               VARCHAR(100) NULL,
  nom              VARCHAR(50)  NULL,
  prenom           VARCHAR(25)  NULL,
  adresse          TEXT         NULL,
  cp               VARCHAR(15)  NULL,
  ville            VARCHAR(25)  NULL,
  teldom           VARCHAR(15)  NULL,
  telport          VARCHAR(15)  NULL,
  telbureau        VARCHAR(15)  NULL,
  civilite         VARCHAR(15)  NULL,
  telecopie        VARCHAR(15)  NULL,
  email            VARCHAR(50)  NULL,
  particulier_prof INT(2)       NULL,
  permis           VARCHAR(25)  NULL,
  remise           FLOAT(5, 5)  NULL,
  derniere_facture VARCHAR(10)  NULL,
  PRIMARY KEY (id
  )
);

CREATE TABLE garage_vehicule (
  id                INT(5)      NOT NULL AUTO_INCREMENT,
  immat             VARCHAR(15) NOT NULL,
  id_proprietaire   INT(5)      NOT NULL DEFAULT '0',
  date_mec          VARCHAR(10) NULL,
  kilometrage       INT(10)     NULL,
  dernier_ct        VARCHAR(10) NULL,
  prochain_ct       VARCHAR(10) NULL,
  id_marque         INT(5)      NOT NULL DEFAULT '0',
  gamme             VARCHAR(25) NULL,
  modele_version    VARCHAR(25) NULL,
  energie           VARCHAR(20) NULL,
  genre             VARCHAR(10) NULL,
  vin               VARCHAR(25) NULL,
  date_garantie     VARCHAR(10) NULL,
  date_distribution VARCHAR(10) NULL,
  km_distribution   INT(10)     NULL,
  date_vidange      VARCHAR(10) NULL,
  km_vidange        INT(10)     NULL,
  date_cg           VARCHAR(10) NULL,
  observation       TEXT        NULL,
  PRIMARY KEY (id)
);

CREATE TABLE garage_intervention (
  id                  INT(5)       NOT NULL AUTO_INCREMENT,
  id_voiture          INT(5)       NOT NULL,
  kilometrage         INT(10)      NULL,
  date_debut          VARCHAR(10)  NULL,
  date_fin            VARCHAR(10)  NULL,
  delai               VARCHAR(10)  NULL,
  id_inter_recurrente INT(5)       NULL,
  description         TEXT         NULL,
  observation         TEXT         NULL,
  date_devis          VARCHAR(10)  NULL,
  date_acceptation    VARCHAR(10)  NULL,
  montant             FLOAT(10, 5) NULL,
  acompte_verse       FLOAT(10, 5) NULL,
  solde               INT(3)       NULL,
  hmeca_t1            FLOAT(10, 5) NULL,
  hmeca_t2            FLOAT(10, 5) NULL,
  hmeca_t3            FLOAT(10, 5) NULL,
  hcarro_t1           FLOAT(10, 5) NULL,
  hcarro_t2           FLOAT(10, 5) NULL,
  hcarro_t3           FLOAT(10, 5) NULL,
  tmeca_t1            FLOAT(10, 5) NULL,
  tmeca_t2            FLOAT(10, 5) NULL,
  tmeca_t3            FLOAT(10, 5) NULL,
  tcarro_t1           FLOAT(10, 5) NULL,
  tcarro_t2           FLOAT(10, 5) NULL,
  tcarro_t3           FLOAT(10, 5) NULL,
  remise_meca         FLOAT(10, 5) NULL,
  remise_caro         FLOAT(10, 5) NULL,
  remise_forfait      FLOAT(10, 5) NULL,
  numero_devis        INT(10)      NULL,
  numero_facture      INT(10)      NULL,
  PRIMARY KEY (id)
);

CREATE TABLE garage_inter_forfait (
  id              INT(5)       NOT NULL AUTO_INCREMENT,
  id_inter        INT(5)       NOT NULL,
  id_forfait      INT(5)       NULL,
  designation     TEXT         NULL,
  ref_fournisseur VARCHAR(25)  NULL,
  quantite        INT(10)      NULL     DEFAULT 1,
  tarif_client    FLOAT(10, 2) NULL,
  remise_forfait  FLOAT(10, 2) NULL,
  PRIMARY KEY (id, id_inter
  )
);

CREATE TABLE garage_inter_pieces (
  id              INT(5)       NOT NULL AUTO_INCREMENT,
  id_inter        INT(5)       NOT NULL,
  id_piece        INT(5)       NULL,
  designation     TEXT         NULL,
  id_fournisseur  INT(5)       NULL,
  ref_fournisseur VARCHAR(25)  NULL,
  quantite        INT(10)      NULL     DEFAULT 1,
  tarif_ha        FLOAT(10, 5) NULL,
  tarif_client    FLOAT(10, 5) NULL,
  id_cat_piece    INT(5)       NULL,
  remise_pieces   FLOAT(10, 2) NULL,
  PRIMARY KEY (id, id_inter
  )
);

CREATE TABLE garage_inter_temp (
  id          INT(5)       NOT NULL AUTO_INCREMENT,
  id_inter    INT(5)       NOT NULL,
  id_empl     INT(5)       NULL,
  observation TEXT         NULL,
  hmeca_t1    FLOAT(10, 5) NULL,
  hmeca_t2    FLOAT(10, 5) NULL,
  hmeca_t3    FLOAT(10, 5) NULL,
  hcarro_t1   FLOAT(10, 5) NULL,
  hcarro_t2   FLOAT(10, 5) NULL,
  hcarro_t3   FLOAT(10, 5) NULL,
  tmeca_t1    FLOAT(10, 5) NULL,
  tmeca_t2    FLOAT(10, 5) NULL,
  tmeca_t3    FLOAT(10, 5) NULL,
  tcarro_t1   FLOAT(10, 5) NULL,
  tcarro_t2   FLOAT(10, 5) NULL,
  tcarro_t3   FLOAT(10, 5) NULL,
  remise_mod  FLOAT(10, 2) NULL,
  PRIMARY KEY (id, id_inter)
);

CREATE TABLE garage_forfait (
  id          INT(5)       NOT NULL AUTO_INCREMENT,
  nom         VARCHAR(50)  NULL,
  description TEXT         NULL,
  tarif       FLOAT(10, 5) NULL,
  PRIMARY KEY (id
  )
);

CREATE TABLE garage_nomenc_forfait (
  id          INT(5)       NOT NULL AUTO_INCREMENT,
  id_forfait  INT(5)       NOT NULL,
  designation TEXT         NULL,
  quantite    INT(10)               DEFAULT '1',
  tarif       FLOAT(10, 5) NULL,
  PRIMARY KEY (id
  )
);

CREATE TABLE garage_pieces (
  id              INT(5)       NOT NULL AUTO_INCREMENT,
  ref             TEXT         NULL,
  designation     TEXT         NULL,
  id_fournisseur  INT(5)       NULL,
  ref_fournisseur VARCHAR(25)  NULL,
  tarif_ha        FLOAT(10, 5) NULL,
  tarif_client    FLOAT(10, 5) NULL,
  id_cat_piece    INT(5)       NULL,
  PRIMARY KEY (id
  )
);

CREATE TABLE garage_cat_piece (
  id  INT(5) NOT NULL AUTO_INCREMENT,
  nom TEXT   NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE garage_fournisseur (
  id      INT(5)      NOT NULL AUTO_INCREMENT,
  nom     TEXT        NULL,
  adresse TEXT        NULL,
  tel     VARCHAR(25) NULL,
  fax     VARCHAR(25) NULL,
  email   VARCHAR(50) NULL,
  PRIMARY KEY (id)
);

CREATE TABLE garage_marque (
  id  INT(5) NOT NULL AUTO_INCREMENT,
  nom TEXT   NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE garage_employe (
  id_empl  INT(5)      NOT NULL AUTO_INCREMENT,
  nom_empl VARCHAR(20) NULL,
  pre_empl VARCHAR(20) NULL,
  PRIMARY KEY (id_empl)
);

CREATE TABLE garage_num_doc (
  type_doc VARCHAR(10) NULL,
  num_doc  INT(10)     NULL
);

CREATE TABLE garage_doc (
  id_doc VARCHAR(25) NULL,
  doc_fr TEXT        NOT NULL,
  UNIQUE KEY (id_doc)
);

#
# Dumping data
#
INSERT INTO `garage_num_doc` VALUES ('DEVIS', 1);
INSERT INTO `garage_num_doc` VALUES ('FACTURE', 1);

INSERT INTO `garage_doc` VALUES ('Client', 'Be careful, the customer deletion is permanent');
INSERT INTO `garage_doc` VALUES ('Vehicule', 'Cars already repaired in the garage');
INSERT INTO `garage_doc` VALUES ('Piece', 'Spare parts available in repair');
INSERT INTO `garage_doc` VALUES ('Cat_Piece', 'The categories allow to sort the spare parts');
INSERT INTO `garage_doc` VALUES ('Employe', 'Workers of the garage</i>');
INSERT INTO `garage_doc` VALUES ('Fournisseur', 'Suppliers of the spare parts');
INSERT INTO `garage_doc` VALUES ('Marque', 'Be careful : do not delete a car maker used in the car table');
INSERT INTO `garage_doc` VALUES ('forfait', 'If no package exist the function is hide in user side');

INSERT INTO `garage_marque` VALUES (1, 'Renault');
INSERT INTO `garage_marque` VALUES (2, 'Peugeot');
INSERT INTO `garage_marque` VALUES (3, 'Citroen');
INSERT INTO `garage_marque` VALUES (4, 'Volvo');
INSERT INTO `garage_marque` VALUES (5, 'Fiat');
INSERT INTO `garage_marque` VALUES (6, 'Audi');
INSERT INTO `garage_marque` VALUES (7, 'Volkswagen');
INSERT INTO `garage_marque` VALUES (8, 'Rover');
INSERT INTO `garage_marque` VALUES (9, 'Mercedes');
INSERT INTO `garage_marque` VALUES (10, 'BMW');
INSERT INTO `garage_marque` VALUES (0, '- Divers -');

INSERT INTO `garage_cat_piece` VALUES (1, 'Carrosserie');
INSERT INTO `garage_cat_piece` VALUES (2, 'Electricit&eacute;');
INSERT INTO `garage_cat_piece` VALUES (3, 'Mecanique');
INSERT INTO `garage_cat_piece` VALUES (4, 'Freinage');

INSERT INTO `garage_clients` VALUES
  (1, '123456', '', 'DUPOND', 'Jean', '1 rue Xoops', '41000', 'BLOIS', '0254545454', '066006600', '', 'M.', '', '', 1,
   '123456879', 0, NULL);
INSERT INTO `garage_clients` VALUES
  (2, '456789', 'Charpente DUCLOU', 'DUCLOU', 'Christophe', '1 rue GPL', '41020', 'DANZE LES BLOSI', '', '', '', 'M.',
   '', '', 1, '123456879', 0, NULL);
INSERT INTO `garage_clients` VALUES (0, '', '', '- Divers -', '', '', '', '', '', '', '', '', '', '', 1, '', 0, NULL);

INSERT INTO `garage_employe` VALUES (1, 'LABOSSE', 'Carl');
INSERT INTO `garage_employe` VALUES (2, 'DUMOULIN', 'Kevin');

INSERT INTO `garage_fournisseur`
VALUES (2, 'Capail', '11 bis rue joseph cugnot\r\n37300 TOURS', '02 47 75 30 30', '02 47 75 30 31', 'capail@orange.fr');
INSERT INTO `garage_fournisseur` VALUES (4, 'autre', '', '', '', '');

INSERT INTO `garage_vehicule`
VALUES
  (1, 'AA 12345 AA', 1, '2010-08-04', 32111, '2010-08-04', '2010-08-04', 6, '', '', 'Essence', '', '', '2010-08-04',
   '2010-08-04', 0, '2010-08-04', 0, '2010-08-04', '');
