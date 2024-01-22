<?php
    declare(strict_types=1);

    // Inclusion de l'autoloader pour charger automatiquement les classes
    require 'Classes/autoloader.php';
    Autoloader::register();

    // Utilisation de la classe Form du namespace Action
    use Action\Form;

    // Définition du fichier JSON par défaut
    $fichier = 'test.json';

    // Vérification si un fichier est spécifié dans la requête
    if (isset($_REQUEST['fichier'])) {
        $fichier = $_REQUEST['fichier'];
    }

    // Création d'une instance de la classe Provider pour obtenir le formulaire
    $provider = new Provider($fichier);
    $form = $provider->getForm();

    // Fonction pour modifier le format du label (remplacement d'espaces et points par des underscores)
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
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
            // Variables pour stocker les points du formulaire et le total des points
            $pointsFormulaire = 0;
            $totalPoints = 0;

            // Affichage du formulaire
            echo '<form>';
            foreach ($form->getQuestions() as $question) {
                // Variables pour stocker les points de chaque question
                $pointsQuestion = 0;

                // Affichage d'un ensemble de questions
                echo '<fieldset>';
                echo '<legend>' . $question->getLabel() . '</legend>';

                foreach ($question->getChoices() as $choix) {
                    $class = ''; // Classe pour la mise en forme CSS
                    $labelPOST = modifFormat($question->getLabel());

                    echo '<div>';
                    
                    // Affichage de la réponse sélectionnée si elle correspond à la valeur de choix
                    if ($_POST[$labelPOST] === $choix) {
                        echo '<input type="' . $question->getType() . '" id="' . $question->getId() . '" name="' . $question->getLabel() . '" value="' . $choix . '" checked disabled/>';
                    } else {
                        echo '<input type="' . $question->getType() . '" id="' . $question->getId() . '" name="' . $question->getLabel() . '" value="' . $choix . '" disabled/>';
                    }

                    // Couleurs basées sur la réponse correcte ou incorrecte
                    if ($question->getAnswer() === $choix) {
                        $class .= "answer";
                    } else if ($_POST[$labelPOST] === $choix) {
                        $class .= "wrong";
                    }

                    // Calcul des points pour la question
                    if ($question->getAnswer() === $choix && $_POST[$labelPOST] === $choix) {
                        $pointsFormulaire += $question->getPoints();
                        $pointsQuestion += $question->getPoints();
                    }

                    // Affichage du label avec la classe de mise en forme
                    echo '<label for="' . $choix . '" class=' . $class . '>' . $choix . '</label>';
                    echo '</div>';
                }

                // Affichage des points pour la question et la réponse correcte
                echo '<p>Points: ' . $pointsQuestion . "/" . $question->getPoints() . '</p>';
                echo '<p>Réponse: ' . $question->getAnswer() . '</p>';

                // Mise à jour du total des points
                $totalPoints += $question->getPoints();

                echo '</fieldset>';
            }

            // Affichage du total des points du formulaire
            echo '<p>Total: ' . $pointsFormulaire . "/" . $totalPoints . '</p>';
            echo '</form';
        ?>
        
        <!-- Lien pour retourner à l'accueil -->
        <a href="index.php">
            <button>Retour à l'accueil</button>
        </a>
    </body>
</html>
