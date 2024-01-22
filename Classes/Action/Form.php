<?php
    // Déclare que les types stricts doivent être utilisés dans ce fichier
    declare(strict_types=1);
    
    // Utilise l'espace de noms (namespace) "Action"
    namespace Action;

    // Importe la classe Question du namespace Quizz
    use Quizz\Question;

    // Définit la classe Form
    class Form {
        // Propriété privée pour stocker le nom du fichier
        private $fichier;
        // Propriété privée pour stocker un tableau de questions
        private $questions;
        
        // Constructeur de la classe, prend un nom de fichier et un tableau de questions en paramètres
        public function __construct(string $fichier, array $questions) {
            // Initialise les propriétés avec les valeurs passées en paramètres
            $this->fichier = $fichier;
            $this->questions = $questions;
        }

        // Méthode pour ajouter une question à la liste de questions
        public function addQuestion(Question $question): void {
            // Ajoute la question au tableau de questions
            $this->questions[] = $question;
        }

        // Méthode pour récupérer la liste de questions
        public function getQuestions(): array {
            // Retourne le tableau de questions
            return $this->questions;
        }

        // Méthode pour générer le code HTML du formulaire
        public function display(): string {
            // Initialise le code HTML du formulaire avec l'action et la méthode de soumission
            $html = '<form action="reponse.php?fichier=' . $this->fichier . '" method="post">';
            
            // Parcourt chaque question et ajoute son affichage au code HTML du formulaire
            foreach ($this->questions as $question) {
                $html .= $question->display();
            }
            
            // Ajoute un bouton de soumission au formulaire
            $html .= '<input type="submit" value="Submit">';
            
            // Ferme la balise du formulaire
            $html .= '</form>';
            
            // Retourne le code HTML généré
            return $html;
        }
    }
?>
