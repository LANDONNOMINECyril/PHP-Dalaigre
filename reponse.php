<?php
    declare(strict_types=1);
    
    require 'Classes/autoloader.php';
    Autoloader::register();
    require 'bd.php';

    $numEssai = $db->exec($queryMaxIdEssai) + 1;

    use Action\Form;

    $fichier = 'test.json';
    if (isset($_REQUEST['fichier'])) {
        $fichier = $_REQUEST['fichier'];
    }
    // prendre le fichier de la BD à la place du provider
    $provider = new Provider($fichier);
    $form = $provider->getForm();

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
            $pointsFormulaire = 0;
            $totalPoints = 0;
            echo '<form>';
            foreach ($form->getQuestions() as $question) {
                $pointsQuestion = 0;
                echo '<fieldset>';
                echo '<legend>' . $question->getLabel() . '</legend>';
                foreach ($question->getChoices() as $choix) {
                    $class = '';
                    $labelPOST = modifFormat($question->getLabel());
                    echo '<div>';
                    if($_POST[$labelPOST] === $choix){
                        echo '<input type="' . $question->getType() . '" id="' . $question->getId() . '" name="' . $question->getLabel() . '" value="' . $choix . '" checked disabled/>';
                    } else {
                        echo '<input type="' . $question->getType() . '" id="' . $question->getId() . '" name="' . $question->getLabel() . '" value="' . $choix . '" disabled/>';
                    }
                    // couleurs
                    if ($question->getAnswer() === $choix) {$class .= "answer";}
                    else if ($_POST[$labelPOST] === $choix) {$class .= "wrong";}
                    //points
                    if ($question->getAnswer() === $choix && $_POST[$labelPOST] === $choix) {
                        $pointsFormulaire+=$question->getPoints();
                        $pointsQuestion+=$question->getPoints();
                    }
                    echo '<label for="' . $choix . '" class=' . $class . '>' . $choix . '</label>';
                    echo '</div>';
                } $totalPoints+=$question->getPoints();
                echo '<p>Points: ' . $pointsQuestion . "/" . $question->getPoints() . '</p>';
                echo '<p>Réponse: ' . $question->getAnswer() . '</p>';
                echo '</fieldset>';
            }
            echo '<p>Total: ' . $pointsFormulaire . "/" . $totalPoints . '</p>';
            echo '</form>';
        ?>
    </body>
</html>
