<?php
    // Déclare que les types stricts doivent être utilisés dans ce fichier
    declare(strict_types=1);

    // Définit la classe Autoloader
    class Autoloader {
        
        // Méthode statique pour enregistrer l'autoloader
        public static function register() {
            spl_autoload_register(array(__CLASS__, 'autoload'));
        }
        
        // Méthode statique pour charger automatiquement les classes
        static function autoload($fqcn) {
            // Convertit les barres obliques inverses en barres obliques pour obtenir le chemin du fichier
            $path = str_replace('\\', '/', $fqcn);
            
            // Inclut le fichier de la classe en utilisant le chemin obtenu
            require "Classes/" . $path . '.php';
        }
    }
?>
