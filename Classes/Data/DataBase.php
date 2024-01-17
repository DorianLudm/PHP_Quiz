<?php 
    namespace Data;
    class DataBase{
        private $file_db;
        public function __construct(){
            $this->file_db=new \PDO('sqlite:Question');
            $this->file_db->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_WARNING);
        }
        public function createTable(){
            $this->file_db->exec("CREATE TABLE IF NOT EXISTS Question ( 
                id_question INTEGER PRIMARY KEY,
                name TEXT,
                type TEXT,
                text TEXT,
                answer TEXT,
                score INTEGER)");
            $this->file_db->exec("CREATE TABLE IF NOT EXISTS Question_Choises ( 
                id_question INTEGER,
                text TEXT,
                value TEXT)");
        }
        public function insertData($id_question,$name,$type,$text,$answer,$score){
            $insert="INSERT INTO Question (id_question, name, type, text, answer, score) VALUES (:id_question, :name, :type, :text, :answer, :score)";
            $stmt=$this->file_db->prepare($insert);
            $stmt->bindParam(':id_question',$id_question);
            $stmt->bindParam(':name',$name);
            $stmt->bindParam(':type',$type);
            $stmt->bindParam(':text',$text);
            $stmt->bindParam(':answer',$answer);
            $stmt->bindParam(':score',$score);
            $stmt->execute();
        }
        public function load(){
            $result=$this->file_db->query('SELECT * from Question');
            $questions =  [];
            foreach ($result as $m){
                $m["answer"] = explode(",",$m["answer"]);
                $q = [];
                $q["name"] = $m["name"];
                $q["type"] = $m["type"];
                $q["text"] = $m["text"];
                $q["answer"] = $m["answer"];
                $q["score"] = $m["score"];
                $q["choices"] = [];
                $result2=$this->file_db->query('SELECT * from Question_Value WHERE id_question='.$m["id_question"]);
                foreach ($result2 as $n){
                    $choix = [];
                    $choix["text"] = $n["text"];
                    $choix["value"] = $n["value"];
                    $q["choices"][] = $choix;
                }
                $questions[] = $q;
            }
            return $questions;
        }   
    }
?>