<?php
    // Déclare que les types stricts doivent être utilisés dans ce fichier
    declare(strict_types=1);

    // Utilise les classes Form et Radio des namespaces Action et Quizz respectivement
    use Action\Form;
    use Quizz\Radio;

    // Définit la classe Provider
    class Provider {

        // Propriétés privées de la classe
        private $data;
        private $fichier;

        // Constructeur de la classe
        public function __construct($fichier) {
            // Vérifie si le chemin du fichier commence par "data/"
            if (strpos($fichier, "data/") === 0) {
                $this->fichier = $fichier;
            } else {
                // Si non, ajoute le préfixe "data/"
                $this->fichier = "data/" . $fichier;
            }

            // Charge le contenu du fichier JSON et le décode en tant que tableau associatif
            $this->data = json_decode(file_get_contents($this->fichier), true);
        }

        // Méthode pour obtenir un objet de la classe Form à partir des données du fichier JSON
        public function getForm(): Form {
            // Initialise un tableau pour stocker les questions
            $questions = [];

            // Parcourt les données du fichier JSON
            foreach ($this->data as $question) {
                // Récupère les informations de la question
                $id = $question["uuid"];
                $id = intval($id);
                $type = $question["type"];
                $label = $question["label"];
                $points = $question["points"];
                $points = intval($points);

                // Crée une instance de la classe Radio si le type est "radio"
                switch ($type) {
                    case 'radio':
                        $choices = $question["choices"];
                        $correct = $question["correct"];
                        // Ajoute la question au tableau des questions
                        array_push($questions, new Radio($id, $label, $choices, $correct, $points));
                        break;
                    default:
                        // Peut être étendu pour d'autres types de questions
                        break;
                }
            }

            // Retourne un nouvel objet de la classe Form avec les questions
            return new Form($this->fichier, $questions);
        }
    }
?>
