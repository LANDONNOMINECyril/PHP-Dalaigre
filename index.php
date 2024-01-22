<?php
    declare(strict_types=1);
    require_once "data/Bd.php";
    require 'Classes/autoloader.php';
    Autoloader::register();

    use Action\Form;
    use Quizz\Radio;
    use BDD\Bd;
    $fichier = getJson();
    if (isset($_REQUEST['fichier'])) {
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
