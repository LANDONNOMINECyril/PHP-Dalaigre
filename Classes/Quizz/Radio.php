<?php
    // Déclare que les types stricts doivent être utilisés dans ce fichier
    declare(strict_types=1);

    // Définit la classe Radio dans le namespace Quizz
    namespace Quizz;

    // Utilise la classe Question du même namespace
    use Quizz\Question;

    // Définit la classe Radio qui étend la classe Question
    class Radio extends Question {

        // Constructeur de la classe Radio
        public function __construct(int $id, string $label, array $choices, string $answer, int $points) {
            // Appelle le constructeur de la classe parente Question
            parent::__construct($id, "radio", $label, $choices, $answer, $points);
        }

        // Méthode pour générer le code HTML spécifique pour une question de type "radio"
        public function display(): string {
            // Initialise le code HTML avec un fieldset et une légende
            $html = '<fieldset>';
            $html .= '<legend>' . $this->getLabel() . '</legend>';

            // Parcourt les choix possibles et les ajoute au code HTML
            foreach ($this->getChoices() as $choice) {
                $idRep = $this->getId() . $choice;
                $html .= '<div>';
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
