<?php
    // Déclare que les types stricts doivent être utilisés dans ce fichier
    declare(strict_types=1);

    // Définit la classe Question dans le namespace Quizz
    namespace Quizz;

    // Définit la classe Question
    class Question {
        // Propriétés privées de la classe
        private int $id;
        private string $type;
        private string $label;
        private array $choices;
        private string $answer;
        private int $points;
        
        // Constructeur de la classe
        public function __construct(int $id, string $type, string $label, array $choices, string $answer, int $points) {
            $this->id = $id;
            $this->type = $type;
            $this->label = $label;
            $this->choices = $choices;
            $this->answer = $answer;
            $this->points = $points;
        }

        // Méthode pour générer le code HTML de l'affichage de la question
        public function display(): string {
            // Initialise le code HTML avec un fieldset et une légende
            $html = '<fieldset>';
            $html .= '<legend>' . $this->label . '</legend>';

            // Parcourt les choix possibles et les ajoute au code HTML
            foreach ($this->choices as $choice) {
                $html .= '<div>';
                $html .= '<input type="' . $this->type . '" id="' . $choice . '" name="' . $this->label . '" value="' . $choice . '"/>';
                $html .= '<label for="' . $choice . '">' . $choice . '</label>';
                $html .= '</div>';
            }

            // Ferme la balise du fieldset
            $html .= '</fieldset>';
            // Retourne le code HTML généré
            return $html;
        }

        // Méthode pour récupérer l'identifiant de la question
        public function getId(): int {
            return $this->id;
        }

        // Méthode pour récupérer le type de la question
        public function getType(): string {
            return $this->type;
        }

        // Méthode pour récupérer le libellé de la question
        public function getLabel(): string {
            return $this->label;
        }

        // Méthode pour récupérer les choix possibles de la question
        public function getChoices(): array {
            return $this->choices;
        }

        // Méthode pour récupérer la réponse attendue de la question
        public function getAnswer(): string {
            return $this->answer;
        }

        // Méthode pour récupérer les points associés à la question
        public function getPoints(): int {
            return $this->points;
        }
    }
?>
