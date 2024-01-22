<?php
    // Déclare que les types stricts doivent être utilisés dans ce fichier
    declare(strict_types=1);

    // Utilise l'espace de noms (namespace) "Quizz"
    namespace Quizz;

    // Importe la classe Question
    use Quizz\Question;

    // Définit la classe Radio qui hérite de la classe Question
    class Radio extends Question {

        // Constructeur de la classe, appelle le constructeur de la classe parente (Question)
        public function __construct(int $id, string $label, array $choices, string $answer, int $points) {
            parent::__construct($id, "radio", $label, $choices, $answer, $points);
        }

        // Méthode pour générer le code HTML de l'affichage d'une question de type Radio
        public function display(): string {
            $html = '<fieldset>';
            // Utilise la balise "legend" pour afficher le libellé de la question
            $html .= '<legend>' . $this->getLabel() . '</legend>';
            
            // Parcourt chaque choix possible de la question et les ajoute au code HTML
            foreach ($this->getChoices() as $choice) {
                $idRep = $this->getId() . $choice;
                $html .= '<div>';
                // Utilise la balise d'entrée de type "radio" pour créer une option de sélection
                $html .= '<input type="radio" id="' . $idRep . '" name="' . $this->getLabel() . '" value="' . $choice . '"/>';
                $html .= '<label for="' . $idRep . '">' . $choice . '</label>';
                $html .= '</div>';
            }
            
            // Ferme la balise du fieldset
            $html .= '</fieldset>';
            // Retourne le code HTML généré
            return $html;
        }
    }
?>
