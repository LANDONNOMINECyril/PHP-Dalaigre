<?php
    // Déclare que les types stricts doivent être utilisés dans ce fichier
    declare(strict_types=1);

    // Inclut le fichier contenant l'autoloader
    require 'Classes/autoloader.php';

    // Enregistre l'autoloader pour charger automatiquement les classes
    Autoloader::register();
    require 'bd.php';

    $numEssai = $db->exec($queryMaxIdEssai) + 1;

    // Utilise la classe Form du namespace Action
    use Action\Form;

    // Crée une instance de la classe Form à partir du fichier JSON
    $fichier = 'test.json';
    if (isset($_REQUEST['fichier'])) {
        $fichier = $_REQUEST['fichier'];
    }
    // prendre le fichier de la BD à la place du provider
    $provider = new Provider($fichier);
    $form = $provider->getForm();

    // Fonction pour modifier le format du label
    function modifFormat(string $label): string {
        $chaine = str_replace(" ", "_", $label);
        $chaine = str_replace(".", "_", $chaine);
        return $chaine;
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Questionnaire</title>
        <!-- Inclut le fichier de style CSS -->
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
            // Initialise les variables pour les points
            $pointsFormulaire = 0;
            $totalPoints = 0;

            // Affiche le formulaire avec les réponses et les points
            echo '<form>';
            foreach ($form->getQuestions() as $question) {
                $pointsQuestion = 0;
                echo '<fieldset>';
                echo '<legend>' . $question->getLabel() . '</legend>';
                foreach ($question->getChoices() as $choix) {
                    $class = '';
                    $labelPOST = modifFormat($question->getLabel());
                    echo '<div>';
                    if ($_POST[$labelPOST] === $choix) {
                        echo '<input type="' . $question->getType() . '" id="' . $question->getId() . '" name="' . $question->getLabel() . '" value="' . $choix . '" checked disabled/>';
                    } else {
                        echo '<input type="' . $question->getType() . '" id="' . $question->getId() . '" name="' . $question->getLabel() . '" value="' . $choix . '" disabled/>';
                    }
                    // Gestion des couleurs
                    if ($question->getAnswer() === $choix) {
                        $class .= "answer";
                    } elseif ($_POST[$labelPOST] === $choix) {
                        $class .= "wrong";
                    }
                    // Gestion des points
                    if ($question->getAnswer() === $choix && $_POST[$labelPOST] === $choix) {
                        $pointsFormulaire += $question->getPoints();
                        $pointsQuestion += $question->getPoints();
                    }
                    echo '<label for="' . $choix . '" class=' . $class . '>' . $choix . '</label>';
                    echo '</div>';
                }
                $totalPoints += $question->getPoints();
                echo '<p>Points: ' . $pointsQuestion . "/" . $question->getPoints() . '</p>';
                echo '<p>Réponse: ' . $question->getAnswer() . '</p>';
                echo '</fieldset>';
            }
            echo '<p>Total: ' . $pointsFormulaire . "/" . $totalPoints . '</p>';
            echo '</form>';
        ?>
        <!-- Lien pour retourner à l'accueil -->
        <a href="index.php">
            <button>Retour à l'accueil</button>
        </a>
    </body>
</html>
