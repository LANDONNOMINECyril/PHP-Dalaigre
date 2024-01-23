<?php
    // Déclare que les types stricts doivent être utilisés dans ce fichier
    declare(strict_types=1);


    // Utilise les classes Form et Radio des namespaces Action et Quizz respectivement
    use Action\Form;
    use Quizz\Radio;

    // Définit la classe Provider
    class Provider {

        // Propriétés privées pour stocker les données et le nom du fichier
        private $data;
        private $fichier;

        // Constructeur de la classe, prend le nom du fichier en paramètre
        public function __construct($fichier) {
            // Vérifie si le nom du fichier commence par "data/"
            if (strpos($fichier, "data/") === 0) {
                $this->fichier = $fichier;
            } else {
                // Ajoute "data/" au début du nom du fichier s'il n'est pas présent
                $this->fichier = "data/" . $fichier;
            }

            // Charge le contenu du fichier JSON et le décode en tant que tableau associatif
            try { // si problème avec le fichier, utiliser le fichier test.json
                $this->data = json_decode(file_get_contents($this->fichier), true);
            } catch (\Throwable $th) {
                $this->fichier = "data/test.json";
                $this->data = json_decode(file_get_contents($this->fichier), true);
            }
        }

        public function getFichier(): string {
            return $this->fichier;
        }

        // Méthode pour obtenir un formulaire à partir des données
        public function getForm(): Form {

            // Tableau pour stocker les questions
            $questions = [];

            // Parcourt chaque question dans les données
            foreach ($this->data as $question) {
                // Récupère les attributs de la question depuis les données
                $id = intval($question["uuid"]);
                $type = $question["type"];
                $label = $question["label"];
                $points = intval($question["points"]);

                // Selon le type de question, crée une instance appropriée de la classe Question
                switch ($type) {
                    case 'radio':
                        $choices = $question["choices"];
                        $correct = $question["correct"];
                        // Ajoute une nouvelle instance de Radio au tableau de questions
                        array_push($questions, new Radio($id, $label, $choices, $correct, $points));
                        break;
                    default:
                        // Cas par défaut (peut être étendu pour d'autres types de questions)
                        break;
                }
            }

            // Retourne une nouvelle instance de Form avec les questions obtenues
            return new Form($this->fichier, $questions);
        }
    }
?>
