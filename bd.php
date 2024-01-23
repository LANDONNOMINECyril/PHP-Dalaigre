<?php
// site : https://geoffroycochard.github.io/iuto.but2.php/php-mysqli/

// Ouvrir (ou créer) la base de données SQLite
$db = new SQLite3('formulaire.db');

// Tables de gestion de formulaire
$query = 'CREATE TABLE IF NOT EXISTS FORMULAIRE (
    id_form INTEGER PRIMARY KEY AUTOINCREMENT,
    nom_fichier TEXT,
    contenu TEXT,
    nb_points INTEGER
)';
$db->exec($query);

// Tables d'enregistrement des scores
$query = 'CREATE TABLE IF NOT EXISTS SCORE (
    id_tentative INTEGER PRIMARY KEY AUTOINCREMENT,
    id_form TEXT,
    nb_points INTEGER
)';
$db->exec($query);

// Fermer la connexion à la base de données
// $db->close();
?>
