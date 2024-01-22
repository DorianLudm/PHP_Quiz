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
                $html .= "<input type='radio' name='".$this->id."' value='".$c['value']."' id='".$this->id."-$i'>";
                $html .= "<label for='".$this->id."-$i'>".$c['text']."</label>";
            }
        }
        $html .= "<br>";
        return $html;
    }
}

?>