<?php
    use Form\QuestionType\{Question, Text, Radio, Checkbox};

    class Factory{
        public static function createQuestions(Array $data): Array{
            $listeQuestion = [];
            foreach($data as $question){
                $className = "Form\\QuestionType\\".ucfirst($question["type"]);
                array_push($listeQuestion, new $className(intval($question["text"]), $question["choices"], $question["answer"], $question["text"], $question["type"]));
            }
            return $listeQuestion;
        }
    }
?>