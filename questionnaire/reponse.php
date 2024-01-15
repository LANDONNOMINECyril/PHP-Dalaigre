<?php
    declare(strict_types=1);
    
    require 'Classes/autoloader.php';
    Autoloader::register();

    use Action\Form;

    $fichier = 'test.json';
    if ($_REQUEST != null) {
        $fichier = $_REQUEST['fichier'];
    }
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
            $html = '<form>';
            foreach ($form->getQuestions() as $question) {
                $html .= '<fieldset>';
                $html .= '<legend>' . $label . '</legend>';
                echo $question->display();
                foreach ($qestion->getChoices() as $choix) {
                    $html .= '<div>';
                    $html .= '<input type=' . $type . ' id=' . $choix . ' name=' . $label . ' value=' . $choix . 'disabled/>';
                    $html .= '<label for=' . $choix . '>' . $choix . '</label>';
                    $html .= '</div>';
                }
                $html .= '</fieldset>';
            }
            $html .= '</form>';
            return $html;
        ?>
    </body>
</html>