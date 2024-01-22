<?php
    declare(strict_types=1);

    namespace Quizz;

    use Quizz\Question;

    class Radio extends Question{

        public function __construct(int $id, string $label, array $choices, string $answer, int $points) {
            parent::__construct($id, "radio", $label, $choices, $answer, $points);
        }

        public function display(): string {
            $html = '<fieldset>';
            $html .= '<legend>' . $this->getLabel() . '</legend>';
            foreach ($this->getChoices() as $question) {
                $idRep = $this->getId().$question;
                $html .= '<div>';
                $html .= '<input type="radio" id="' . $idRep . '" name="' . $this->getLabel() . '" value="' . $question . '"/>';
                $html .= '<label for="' . $idRep . '">' . $question . '</label>';
                $html .= '</div>';
            }
            $html .= '</fieldset>';
            return $html;
        }
    }
?>