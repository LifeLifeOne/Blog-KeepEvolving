<?php 

namespace App\core;

class Https {
    
    /**
     * Mettre les url actives ou non selon la page sur laquelle le visiteur se trouve
     */
    public static function active(string $path)  {
    
        return ($_GET['p'] === $path) ? "class = 'active-link'" : '';
            
    } 

    /**
     *  Redirection
     */
    public static function redirect(string $path) :void {

        header('Location: '.$path);
        exit;
        
    }
    
}