<?php
// site : https://geoffroycochard.github.io/iuto.but2.php/php-mysqli/

// CE SONT DES ESSAIS QUI N'ONT PAS ÉTÉ TESTÉS

// Ouvrir (ou créer) la base de données SQLite
$db = new SQLite3('ma_base_de_donnees.db');

// Tables de gestion de formulaire
// Créer table FORMULAIRE
$query = 'CREATE TABLE IF NOT EXISTS FORMULAIRE (
    id INTEGER PRIMARY KEY AUTOINCREMENT
)';
$db->exec($query);

// Créer table QUESTION
$query = 'CREATE TABLE IF NOT EXISTS QUESTION (
    id INTEGER,
    uuid INTEGER,
    typeQ VARCHAR(42),
    label VARCHAR(42),
    correct VARCHAR(42),
    PRIMARY KEY (id, uuid)
)';
$db->exec($query);

// Créer table CHOIX
$query = 'CREATE TABLE IF NOT EXISTS QUESTION (
    uuid INTEGER PRIMARY KEY,
    nom VARCHAR(42),
    PRIMARY KEY (uuid, nom),
    FOREIGN KEY (uuid) REFERENCES QUESTION(uuid)
)';
$db->exec($query);

// Tables d'enregistrement des scores

// Fermer la connexion à la base de données
$db->close();
?>
