<?php
    class Factory{
        public static function createQuestions(Array $data): Array{
            $listeQuestion = [];
            foreach($data as $question){
                array_push($listeQuestion, new Question(intval($question["label"]), $question["choices"], $question["correct"], $question["label"], $question["type"]));
            }
            return $listeQuestion;
        }
    }
?>