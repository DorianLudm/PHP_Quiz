<?php
declare(strict_types=1);
namespace Form\QuestionType;
use Form\QuestionType\Question;

final class Text extends Question {
    protected string $type = 'radio';

    public function render(): String{
        echo $this->question . "<br>";
    }
}

?>