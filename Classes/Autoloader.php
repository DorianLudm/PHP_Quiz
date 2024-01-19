<?php
    class Autoloader{
        /**
         * Enregistre notre autoloader
         */
        static function register(){
            spl_autoload_register(array(__CLASS__, 'autoload'));
        }

        /**
         * Inclue le fichier correspondant à notre classe
         * @param $class string Le nom de la classe à charger
         */
        static function autoload($fqcn){
            if ($fqcn == "Data\\PDO") return;
            $path = str_replace('\\', '/', $fqcn);
            require 'Classes/' . $path . '.php';
        }
    }
?>