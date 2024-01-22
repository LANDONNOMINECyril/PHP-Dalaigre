<?php
    // Déclare que les types stricts doivent être utilisés dans ce fichier
    declare(strict_types=1);

    // Inclut le fichier contenant la classe Bd
    require_once "data/Bd.php";

    // Inclut le fichier contenant l'autoloader
    require 'Classes/autoloader.php';

    // Enregistre l'autoloader pour charger automatiquement les classes
    Autoloader::register();
    require 'bd.php';

    // Utilise les classes Form, Radio, Bd, et Provider
    use Action\Form;
    use Quizz\Radio;
    use BDD\Bd;

    // Obtient le chemin du fichier JSON à partir de la base de données ou de la requête
    $fichier = getJson();
    if (isset($_REQUEST['fichier'])) {
        $fichier = $_REQUEST['fichier'];
    }
    // Crée une instance de la classe Provider avec le chemin du fichier JSON
    $provider = new Provider($fichier);

    // Obtient un formulaire à partir du provider
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
            // Affiche le formulaire
            echo $form->display();
        ?>
    </body>
</html>
