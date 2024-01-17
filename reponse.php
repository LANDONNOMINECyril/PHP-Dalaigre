<?php
    declare(strict_types=1);
    
    require 'Classes/autoloader.php';
    Autoloader::register();

    use Action\Form;

    $fichier = 'test.json';
    if (isset($_REQUEST['fichier'])) {
        $fichier = $_REQUEST['fichier'];
    }
    $provider = new Provider($fichier);
    $form = $provider->getForm();

    function modifFormat(string $label): string {
        return str_replace(" ", "_", $label);
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
            echo '<form>';
            foreach ($form->getQuestions() as $question) {
                echo '<fieldset>';
                echo '<legend>' . $question->getLabel() . '</legend>';
                foreach ($question->getChoices() as $choix) {
                    $labelPOST = modifFormat($question->getLabel());
                    echo '<div>';
                    if($_POST[$labelPOST] === $choix){
                        echo '<input type="' . $question->getType() . '" id="' . $question->getId() . '" name="' . $question->getLabel() . '" value="' . $choix . '" checked disabled/>';
                    } else {
                        echo '<input type="' . $question->getType() . '" id="' . $question->getId() . '" name="' . $question->getLabel() . '" value="' . $choix . '" disabled/>';
                    }
                    if ($question->getAnswer() === $choix) {echo '<label for="' . $choix . '" class="answer">' . $choix . '</label>';}
                    else {echo '<label for="' . $choix . '">' . $choix . '</label>';}
                    echo '</div>';
                } echo '<p>Réponse: ' . $question->getAnswer() . '</p>';
                echo '</fieldset>';
            }
            echo '</form>';
        ?>
    </body>
</html>
