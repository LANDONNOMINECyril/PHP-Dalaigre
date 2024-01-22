<?php
    // Déclare que les types stricts doivent être utilisés dans ce fichier
    declare(strict_types=1);

    // Utilise l'espace de noms (namespace) "Quizz"
    namespace Quizz;
    
    // Définit la classe Question
    class Question {
        // Propriété privée pour stocker l'identifiant de la question
        private int $id;
        // Propriété privée pour stocker le type de la question
        private string $type;
        // Propriété privée pour stocker le libellé de la question
        private string $label;
        // Propriété privée pour stocker les choix possibles de la question
        private $choices;
        // Propriété privée pour stocker la réponse correcte à la question
        private string $answer;
        // Propriété privée pour stocker le nombre de points attribués à la question
        private int $points;
        
        // Constructeur de la classe, prend plusieurs paramètres pour initialiser les propriétés
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
            $html = '<fieldset>';
            // Utilise la balise "legend" pour afficher le libellé de la question
            $html .= '<legend>' . $this->label . '</legend>';
            
            // Parcourt chaque choix possible de la question et les ajoute au code HTML
            foreach ($this->choices as $choice) {
                $html .= '<div>';
                // Utilise les balises d'entrée pour créer des options de sélection
                $html .= '<input type="' . $this->type . '" id="' . $choice . '" name="' . $this->label . '" value="' . $choice . '"/>';
                $html .= '<label for="' . $choice . '">' . $choice . '</label>';
                $html .= '</div>';
            }
            
            // Ferme la balise du fieldset
            $html .= '</fieldset>';
            // Retourne le code HTML généré
            return $html;
        }

        // Méthodes getters pour récupérer les valeurs des propriétés
        public function getId(): int {
            return $this->id;
        }

        public function getType(): string {
            return $this->type;
        }

        public function getLabel(): string {
            return $this->label;
        }

        public function getChoices(): array {
            return $this->choices;
        }

        public function getAnswer(): string {
            return $this->answer;
        }

        public function getPoints(): int {
            return $this->points;
        }
    }
?>
