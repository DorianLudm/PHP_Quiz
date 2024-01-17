<?php
declare(strict_types=1);
namespace Form\QuestionType;
use Form\QuestionType\Question;

final class Checkbox extends Question {
    protected string $type = 'checkbox';

    public function render(): String{
        $html = $this->question . "<br>";
        $i = 0;
        foreach ($this->listeAnswer as $c) {
            $i += 1;
            $html .= "<input type='checkbox' name='$this->name' value='$c[value]' id='$this->name-$i'>";
            $html .= "<label for='$this->name-$i'>$c[text]</label>";
        }
        echo $html;
    }
}

?>