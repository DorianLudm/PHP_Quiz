<?php
declare(strict_types=1);
namespace Form\QuestionType;
use Form\QuestionType\Question;

final class Text extends Question {
    protected string $type = 'radio';

    public function render(): String{
        $html = $this->label . "<br>";
        $html .= "<input type='text' name='".$this->id."' id='".$this->id."'><br>";
        return $html;
    }
}

?>