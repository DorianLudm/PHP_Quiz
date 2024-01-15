<?php
    class Factory{
        public static function createQuestions(Array $data): Array{
            $listeQuestion = [];
            foreach($data as $question){
                $className = "Form\\Type\\".ucfirst($question["type"]);
                array_push($listeQuestion, new $className(intval($question["label"]), $question["choices"], $question["correct"], $question["label"], $question["type"]));
            }
            return $listeQuestion;
        }
    }
?>