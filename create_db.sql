-- Creer le tableau livreur 
CREATE TABLE livreur (
  cin_livreur INT PRIMARY KEY,
  nom_liv VARCHAR(255),
  prenom_liv VARCHAR(255),
  disponibilite VARCHAR(255),
  email_liv VARCHAR(255),
  num_tel_liv VARCHAR(255),
  type_transport VARCHAR(255)
);
-- Creer le tableau client 
CREATE TABLE client (
  id_client INT PRIMARY KEY,
  nom_cli VARCHAR(255),
  prenom_cli VARCHAR(255),
  type_cli VARCHAR(255),
  adresse_cli VARCHAR(255),
  email_cli VARCHAR(255),
  num_tel_cli VARCHAR(255),
  ville_cli VARCHAR(255)
);

-- Creer le tableau point_relais 
CREATE TABLE point_relais (
  position_gps VARCHAR(255) PRIMARY KEY,
  heures_ouverture TIME,
  heures_fermeture TIME,
  jours_disponible VARCHAR(255)
);



-- Creer le tableau colis 
CREATE TABLE colis (
  id_colis INT PRIMARY KEY,
  poids_colis DECIMAL(10,2),
  type_colis VARCHAR(255),
  date_depot_colis DATE,
  cout_colis_estime DECIMAL(10,2),
  cout_effectif DECIMAL(10,2),
  position_actuelle VARCHAR(255),
  point_relais_initiale VARCHAR(255),
  point_relais_finale VARCHAR(255),
  longeur_colis DECIMAL(10,2),
  largeur_colis DECIMAL(10,2)
);

-- Creer le tableau deposer_recuperer 
CREATE TABLE deposer_recuperer (
  id_colis INT,
  id_client INT,
  PRIMARY KEY (id_colis, id_client),
  FOREIGN KEY (id_colis) REFERENCES colis(id_colis),
  FOREIGN KEY (id_client) REFERENCES client(id_client)
);


-- Creer le tableau livraison 
CREATE TABLE livraison (
  id_livraison INT PRIMARY KEY,
  cin_livreur INT,
  date_livraison DATE,
  cout_livraison DECIMAL(10,2),
  FOREIGN KEY (cin_livreur) REFERENCES livreur(cin_livreur)
);
-- Creer le tableau effectue 
CREATE TABLE effectue (
  id_livraison INT,
  position_gps VARCHAR(255),
  date_arrive DATETIME,
  date_depart DATETIME,
  PRIMARY KEY (id_livraison, position_gps),
  FOREIGN KEY (id_livraison) REFERENCES livraison(id_livraison)
);
-- Creer le tableau livre 
CREATE TABLE livre (
  id_livraison INT,
  id_colis INT,
  PRIMARY KEY (id_livraison, id_colis),
  FOREIGN KEY (id_livraison) REFERENCES livraison(id_livraison),
  FOREIGN KEY (id_colis) REFERENCES colis(id_colis)
);