<?php
    declare(strict_types=1);

    // require 'data/test.json'; // je sais pas ce que ça fait mais c'est ça qui fait le print chelou

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
            $questions = [];
            foreach ($this->data as $question) {
                $id = $question["uuid"];
                $id = intval($id);
                $type = $question["type"];
                $label = $question["label"];
                switch ($type) {
                    case 'radio':
                        $choices = $question["choices"];
                        $correct = $question["correct"];
                        array_push($questions, new Radio($id, $label, $choices, $correct));
                        break;
                    default:
                        break;
                }
            }
            return new Form($this->fichier, $questions);
        }
    }
?>