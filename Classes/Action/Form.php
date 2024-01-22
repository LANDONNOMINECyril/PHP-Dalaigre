<?php
    // Déclare que les types stricts doivent être utilisés dans ce fichier
    declare(strict_types=1);

    // Définit la classe Form dans le namespace Action
    namespace Action;

    // Importe la classe Question du namespace Quizz
    use Quizz\Question;

    // Définit la classe Form
    class Form {
        // Propriété privée pour stocker le chemin du fichier
        private $fichier;

        // Propriété privée pour stocker la liste de questions
        private $questions;
        
        // Constructeur de la classe, prend un chemin de fichier et une liste de questions
        public function __construct(string $fichier, array $questions) {
            $this->fichier = $fichier;
            $this->questions = $questions;
        }

        // Méthode pour ajouter une question à la liste
        public function addQuestion(Question $question): void {
            $this->questions[] = $question;
        }

        // Méthode pour récupérer la liste de questions
        public function getQuestions(): array {
            return $this->questions;
        }

        // Méthode pour générer le code HTML du formulaire
        public function display(): string {
            // Initialise le code HTML avec le formulaire et ses questions
            $html = '<form action="reponse.php?fichier=' . $this->fichier . '" method="post">';
            foreach ($this->questions as $question) {
                $html .= $question->display();
            }
            // Ajoute le bouton de soumission
            $html .= '<input type="submit" value="Submit">';
            // Ferme la balise du formulaire
            $html .= '</form>';
            // Retourne le code HTML généré
            return $html;
        }
    }
?>
