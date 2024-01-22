<?php
// site : https://geoffroycochard.github.io/iuto.but2.php/php-mysqli/

// CE SONT DES ESSAIS QUI N'ONT PAS ÉTÉ TESTÉS

// Ouvrir (ou créer) la base de données SQLite
$db = new SQLite3('formulaire.db');

// Tables de gestion de formulaire
// Créer table FORMULAIRE
$query = 'CREATE TABLE IF NOT EXISTS FORMULAIRE (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(42)
)';
$db->exec($query);

// Créer table QUESTION
$query = 'CREATE TABLE IF NOT EXISTS QUESTION (
    id INTEGER,
    uuid INTEGER,
    typeQ VARCHAR(42),
    label VARCHAR(42),
    correct VARCHAR(42),
    points int,
    PRIMARY KEY (id, uuid)
)';
$db->exec($query);

// Créer table CHOIX
$query = 'CREATE TABLE IF NOT EXISTS CHOIX (
    uuid INTEGER,
    nom VARCHAR(42),
    PRIMARY KEY (uuid, nom),
    FOREIGN KEY (uuid) REFERENCES QUESTION(uuid)
)';
$db->exec($query);

// Tables d'enregistrement des scores
// Créer table SCORE
$query = 'CREATE TABLE IF NOT EXISTS SCORE (
    id_essai INTEGER,
    id INTEGER,
    uuid INTEGER, 
    points VARCHAR(42),
    PRIMARY KEY (id_essai, id, uuid),
    FOREIGN KEY (id) REFERENCES FORMULAIRE(id),
    FOREIGN KEY (uuid) REFERENCES QUESTION(uuid)
)';
$db->exec($query);
// quand l'essai est fini (submit et arrivée sur réponses), la base de données enregistre le score pour chaque question associée au formulaire et à l'essai

$queryMaxIdEssai = "SELECT MAX(id_essai) FROM SCORE";

// Fermer la connexion à la base de données
// $db->close();
?>
