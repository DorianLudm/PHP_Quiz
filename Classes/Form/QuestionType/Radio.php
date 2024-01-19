<?php
declare(strict_types=1);
namespace Form\QuestionType;
use Form\QuestionType\Question;

final class Radio extends Question {
    protected string $type = 'radio';

    public function render(): String{
        $html = $this->label . "<br>";
        $i = 0;
        foreach ($this->listeAnswer as $c) {
            if(is_array($c) && isset($c['value']) && isset($c['text'])) {
                $i += 1;
                $html .= "<input type='radio' name='".$this->label."' value='".$c['value']."' id='".$this->label."-$i'>";
                $html .= "<label for='".$this->label."-$i'>".$c['text']."</label>";
            }
        }
        $html .= "<br>";
        return $html;
    }
}

?>