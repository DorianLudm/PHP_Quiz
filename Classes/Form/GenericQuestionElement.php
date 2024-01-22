<?php
    declare(strict_types=1);
    namespace Form;

    class GenericQuestionElement implements QuestionRenderInterface{
        protected string $id;
        protected Array $listeAnswer;
        protected Array $realAnswer;
        protected String $label;
        protected String $type;
        protected int $score;

        public function __construct(string $id, Array $listeAnswer, Array $realAnswer, String $label, String $type, int $score){
            $this->id = $id;
            $this->listeAnswer = $listeAnswer;
            $this->realAnswer = $realAnswer;
            $this->label = $label;
            $this->type = $type;
            $this->score = $score;
        }

        public function getId(): string{
            return $this->id;
        }

        public function getListeAnswer(): Array{
            return $this->listeAnswer;
        }

        public function getRealAnswer(): Array{
            return $this->realAnswer;
        }

        public function getLabel(): String{
            return $this->label;
        }

        public function getType(): String{
            return $this->type;
        }

        public function getScore(): int{
            return $this->score;
        }

        public function render(): String{
            $html = $this->label . "<br>";
            $i = 0;
            foreach ($this->listeAnswer as $c) {
                $i += 1;
                $html .= "<input type='radio' name='$this->name[]' value='$c[value]' id='$this->name-$i'>";
                $html .= "<label for='$this->name-$i'>$c[text]</label>";
            }
            echo $html;
        }

        public function checkAnswer($answer){
            $score_correct = 0;
            if (is_array($answer)) {
                $diff1 = array_diff($answer, $this->getRealAnswer());
                $diff2 = array_diff($this->getRealAnswer(), $answer);
                if (count($diff1) == 0 && count($diff2) == 0) {
                    $question_correct += 1;
                    $score_correct = $this->getScore();
                }
            } else {
                if ($answer == $this->getRealAnswer()[0]) {
                    $question_correct += 1;
                    $score_correct = $this->getScore();
                }
            }
            $this->renderAnswer($answer,$score_correct>0);
            return $score_correct;
        }

        public function renderAnswer($answer, $correct){
            if (is_null($answer?? NULL) || empty($answer ?? NULL)) {
                echo "<p>🤨❓ Vous n'avez pas répondu à cette question</p>";
            }else{
                if ($correct){
                    echo "<p>👍✔️";
                } else{
                    echo "<p>😅❌";
                }
                echo " Vous avez choisi <strong>";
                if (is_array($answer)) {
                    foreach ($answer as $value) {
                        echo $value . " ";
                    }
                }else{
                    echo $answer;
                }
                echo "</strong> pour réponse ( ";
                foreach ($this->realAnswer as $ans){
                    echo $ans . " ";
                }
                echo ")</p>";
            }
        }
        
    }
?>