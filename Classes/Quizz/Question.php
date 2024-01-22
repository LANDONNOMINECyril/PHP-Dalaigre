<?php
    declare(strict_types=1);

    namespace Quizz;
    
    class Question {
        private int $id;
        private string $type;
        private string $label;
        private $choices;
        private string $answer;
        private int $points;
        
        public function __construct(int $id, string $type, string $label, array $choices, string $answer, int $points) {
            $this->id = $id;
            $this->type = $type;
            $this->label = $label;
            $this->choices = $choices;
            $this->answer = $answer;
            $this->points = $points;
            
        }

        public function display(): string {
            $html = '<fieldset>';
            $html .= '<legend>' . $label . '</legend>';
            foreach ($choices as $question) {
                $html .= '<div>';
                $html .= '<input type=' . $type . ' id=' . $question . ' name=' . $label . ' value=' . $question . '/>';
                $html .= '<label for=' . $question . '>' . $question . '</label>';
                $html .= '</div>';
            }
            $html .= '</fieldset>';
            return $html;
        }

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
