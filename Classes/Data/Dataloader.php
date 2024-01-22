<?php
    namespace Data;
    class Dataloader{
        private $chemin;

        public function __construct(String $chemin){
            $this->chemin = $chemin;
        }

        public function load(): Array{
            echo $this->chemin;
            $json = file_get_contents($this->chemin);
            $data = json_decode($json, true);
            return $data;
        }
    }
?>