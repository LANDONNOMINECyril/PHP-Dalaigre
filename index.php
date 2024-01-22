<?php
    declare(strict_types=1);
    
    require 'Classes/autoloader.php';
    Autoloader::register();
    require 'bd.php';

    use Action\Form;
    use Quizz\Radio;

    $fichier = 'test.json';
    if (isset($_REQUEST['fichier'])) {
        $fichier = $_REQUEST['fichier'];
    }
    // si fichier en BD, le charger, sinon, faire le provider et le mettre en BD
    // $query = 'SELECT nom FROM FORMULAIRE WHERE nom = "' . $fichier . '"';
    // $result = $db->query($query);
    // if ($result->fetchArray() === false) {
    //     $provider = new Provider($fichier);
    //     $form = $provider->getForm();
    //     $query = 'INSERT INTO FORMULAIRE (nom) VALUES ("' . $fichier . '")';
    //     $db->exec($query);
    //     $query = 'SELECT id FROM FORMULAIRE WHERE nom = "' . $fichier . '"';
    //     $resId = $db->query($query);
    //     $idForm = $resId->fetchArray()['id'];
    //     foreach ($form->getQuestions() as $question) {
    //         $query = 'INSERT INTO QUESTION (id, uuid, typeQ, label, correct, points) VALUES (' . $idForm . ', ' . $question->getId() . ', "' . $question->getType() . '", "' . $question->getLabel() . '", "' . $question->getAnswer() . '", ' . $question->getPoints() . ')';
    //         $db->exec($query);
    //         foreach ($question->getChoices() as $choix) {
    //             $query = 'INSERT INTO CHOIX (uuid, nom) VALUES (' . $question->getId() . ', "' . $choix . '")';
    //             $db->exec($query);
    //         }
    //     }
    // } else {
    //     // charger le formulaire en BD
    //     $query = 'SELECT * FROM FORMULAIRE WHERE nom = "' . $fichier . '"';
    //     $resultForm = $db->query($query);
    //     $row = $resultForm->fetchArray();
    //     echo $row['id'];
    //     $query = 'SELECT * FROM QUESTION WHERE id = ' . $row['id'];
    //     $resultQuestions = $db->query($query);
    //     $questions = [];
    //     foreach ($resultQuestions as $question) {
    //         $id = $question["uuid"];
    //         $id = intval($id);
    //         $type = $question["type"];
    //         $label = $question["label"];
    //         $points = $question["points"];
    //         $points = intval($points);
    //         switch ($type) {
    //             case 'radio':
    //                 $choices = $question["choices"];
    //                 $correct = $question["correct"];
    //                 array_push($questions, new Radio($id, $label, $choices, $correct, $points));
    //                 break;
    //             default:
    //                 break;
    //         }
    //     }
    //     $form = new Form($fichier, $questions);
    // }
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
