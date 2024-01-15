<?php
    declare (strict_types = 1);

    class Autoloader{
        public static function register(){
            spl_autoload_register(array(__CLASS__, 'autoload'));
        }
        
        static function autoload($fqcn) {
            $path = str_replace('\\', '/', $fqcn);
            require "Classes/".$path.'.php';
        }
    }
?>