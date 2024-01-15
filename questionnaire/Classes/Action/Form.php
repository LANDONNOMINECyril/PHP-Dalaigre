<?php
    declare(strict_types=1);
    
    namespace Action;

    use Quizz\Question;

    class Form {
        private $fichier;
        private $questions;
        
        public function __construct(string $fichier, array $questions) {
            $this->fichier = $fichier;
            $this->questions = $questions;
        }

        public function addQuestion(Question $question): void {
            $this->questions[] = $question;
        }

        public function getQuestions(): array {
            return $this->questions;
        }

        public function display(): string {
            $html = '<form action="reponse.php?fichier="' . $this->fichier . '" method="post">';
            foreach ($this->questions as $question) {
                $html .= $question->display();
            }
            $html .= '<input type="submit" value="Submit">';
            $html .= '</form>';
            return $html;
        }
    }
?>