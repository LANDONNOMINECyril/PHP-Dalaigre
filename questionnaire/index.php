<?php
    declare(strict_types=1);
    
    require 'Classes/autoloader.php';
    Autoloader::register();

    use Action\Form;
    use Quizz\Radio;

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
            echo $form->display();
        ?>
    </body>
</html>
