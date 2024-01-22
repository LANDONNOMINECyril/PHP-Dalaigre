<?php
    declare(strict_types=1);

    // Inclusion du fichier contenant la logique de la base de données (Bd.php)
    require_once "data/Bd.php";

    // Inclusion de l'autoloader pour charger automatiquement les classes
    require 'Classes/autoloader.php';
    Autoloader::register();

    // Utilisation des classes Form, Radio et Bd (Base de données)
    use Action\Form;
    use Quizz\Radio;
    use BDD\Bd;

    // Obtention du chemin du fichier JSON à partir de la base de données
    $fichier = getJson();

    // Vérification si un fichier est spécifié dans la requête
    if (isset($_REQUEST['fichier'])) {
        $fichier = $_REQUEST['fichier'];
    }

    // Création d'une instance de la classe Provider pour obtenir le formulaire
    $provider = new Provider($fichier);
    $form = $provider->getForm();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Questionnaire</title>
    </head>
    <body>
        <?php
            // Affichage du formulaire en utilisant la méthode display() de la classe Form
            echo $form->display();
        ?>
    </body>
</html>
