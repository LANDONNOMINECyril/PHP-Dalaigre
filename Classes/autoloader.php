<?php
    // Déclare que les types stricts doivent être utilisés dans ce fichier
    declare(strict_types=1);

    // Définit la classe Autoloader
    class Autoloader {
        // Méthode statique pour enregistrer l'autoloader
        public static function register() {
            // Enregistre la méthode 'autoload' de cette classe comme fonction d'autoloading
            spl_autoload_register(array(__CLASS__, 'autoload'));
        }
        
        // Méthode statique pour charger automatiquement les classes
        static function autoload($fqcn) {
            // Remplace les antislashes "\" par des slashes "/" dans le nom de la classe
            $path = str_replace('\\', '/', $fqcn);
            
            // Charge le fichier de la classe en utilisant le chemin calculé
            require "Classes/" . $path . '.php';
        }
    }
?>
