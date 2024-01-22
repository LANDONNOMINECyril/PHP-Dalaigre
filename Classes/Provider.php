<?php
    declare(strict_types=1);

    require 'bd.php';

    use Action\Form;
    use Quizz\Radio;

    class Provider {

        private $data;
        private $fichier;

        public function __construct($fichier) {
            if (strpos($fichier, "data/") === 0) {$this->fichier = $fichier;}
            else {$this->fichier = "data/" . $fichier;}
            $this->data = json_decode(file_get_contents($this->fichier), true);
        }

        public function getForm(): Form {
            // $questions = [];
            // foreach ($this->data as $question) {
            //     $id = $question["uuid"];
            //     $id = intval($id);
            //     $type = $question["type"];
            //     $label = $question["label"];
            //     $points = $question["points"];
            //     $points = intval($points);
            //     switch ($type) {
            //         case 'radio':
            //             $choices = $question["choices"];
            //             $correct = $question["correct"];
            //             array_push($questions, new Radio($id, $label, $choices, $correct, $points));
            //             break;
            //         default:
            //             break;
            //     }
            // }
            $query = 'SELECT nom FROM FORMULAIRE WHERE nom = "' . $this->fichier . '"';
            $result = $db->query($query);
            if ($result->fetchArray() === false) {
                $provider = new Provider($this->fichier);
                $form = $provider->getForm();
                $query = 'INSERT INTO FORMULAIRE (nom) VALUES ("' . $this->fichier . '")';
                $db->exec($query);
                $query = 'SELECT id FROM FORMULAIRE WHERE nom = "' . $this->fichier . '"';
                $resId = $db->query($query);
                $idForm = $resId->fetchArray()['id'];
                foreach ($form->getQuestions() as $question) {
                    $query = 'INSERT INTO QUESTION (id, uuid, typeQ, label, correct, points) VALUES (' . $idForm . ', ' . $question->getId() . ', "' . $question->getType() . '", "' . $question->getLabel() . '", "' . $question->getAnswer() . '", ' . $question->getPoints() . ')';
                    $db->exec($query);
                    foreach ($question->getChoices() as $choix) {
                        $query = 'INSERT INTO CHOIX (uuid, nom) VALUES (' . $question->getId() . ', "' . $choix . '")';
                        $db->exec($query);
                    }
                }
            } else {
                // charger le formulaire en BD
                $query = 'SELECT * FROM FORMULAIRE WHERE nom = "' . $this->fichier . '"';
                $resultForm = $db->query($query);
                $row = $resultForm->fetchArray();
                echo $row['id'];
                $query = 'SELECT * FROM QUESTION WHERE id = ' . $row['id'];
                $resultQuestions = $db->query($query);
                $questions = [];
                foreach ($resultQuestions as $question) {
                    $id = $question["uuid"];
                    $id = intval($id);
                    $type = $question["type"];
                    $label = $question["label"];
                    $points = $question["points"];
                    $points = intval($points);
                    switch ($type) {
                        case 'radio':
                            $choices = $question["choices"];
                            $correct = $question["correct"];
                            array_push($questions, new Radio($id, $label, $choices, $correct, $points));
                            break;
                        default:
                            break;
                    }
                }
            }
            return new Form($this->fichier, $questions);
        }
    }
?>