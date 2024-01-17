<?php
    declare(strict_type=1);
    namespace Form;

    class GenericQuestionElement implements QuestionRenderInterface{
        private int $id;
        private Array $listeAnswer;
        private Array $realAnswer;
        private String $label;
        private String $type;

        public function __construct(int $id, Array $listeAnswer, Array $realAnswer, String $label, String $type){
            $this->id = $id;
            $this->listeAnswer = $listeAnswer;
            $this->realAnswer = $realAnswer;
            $this->label = $label;
            $this->type = $type;
        }

        public function getId(): int{
            return $this->id;
        }

        public function getListeAnswer(): Array{
            return $this->listeAnswer;
        }

        public function getRealAnswer(): String{
            return $this->realAnswer;
        }

        public function getLabel(): String{
            return $this->label;
        }

        public function getType(): String{
            return $this->type;
        }

        public function render(): String{
            $html = $this->label . "<br>";
            $i = 0;
            foreach ($this->listeAnswer as $c) {
                $i += 1;
                $html .= "<input type='radio' name='$this->name' value='$c[value]' id='$this->name-$i'>";
                $html .= "<label for='$this->name-$i'>$c[text]</label>";
            }
            echo $html;
        }
    }
?>