<?php
    // Déclare que les types stricts doivent être utilisés dans ce fichier
    declare(strict_types=1);

    // Inclut le fichier contenant l'autoloader
    require 'Classes/autoloader.php';

    // Enregistre l'autoloader pour charger automatiquement les classes
    Autoloader::register();

    require "bd.php";

    // Utilise les classes Form, Radio, Bd, et Provider
    use Action\Form;
    use Quizz\Radio;
    
    // Vérification si un fichier est spécifié dans la requête
    $fichier = "test.json";
    if (isset($_REQUEST['fichier'])) {
        $fichier = $_REQUEST['fichier'];
    }
    // Crée une instance de la classe Provider avec le chemin du fichier JSON
    $provider = new Provider($fichier);

    // Obtient un formulaire à partir du provider
    $form = $provider->getForm();

    // enregistrer le formulaire dans la bd s'il n'y est pas
    $query = "SELECT * FROM FORMULAIRE WHERE nom_fichier = '" . $provider->getFichier() . "'";
    $result = $db->query($query);
    if ($result->fetchArray() == 0) {
        // echo "Le formulaire n'est pas dans la base de données"; // debug
        $query = "INSERT INTO FORMULAIRE (nom_fichier, contenu, nb_points) VALUES ('" . $provider->getFichier() . "', '" . file_get_contents($provider->getFichier()). "', " . $form->getNbPoints() . ")";
        $db->exec($query);
    }

    // // afficher tous les formulaires // debug
    // $query = "SELECT * FROM FORMULAIRE";
    // $result = $db->query($query);
    // while ($row = $result->fetchArray()) {
    //     echo "<p>" . $row['id_form'] . $row['nom_fichier'] . $row['contenu'] . $row['nb_points'] . "</p>";
    // }
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
