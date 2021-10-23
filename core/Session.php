<?php 

namespace App\core;


class Session {
    
    /**
     * DESTRUCTION SESSION
     */
    public static function deconnect() {
        
        session_start();
        session_destroy();
        
    }
    
    /**
     * CREATION D'UNE SESSION USER
     */
    public static function setUserSession(array $sessions):void { 
        
        foreach($sessions as $sessionKey => $sessionValue) {
            // echo '<br>'.$sessionKey.' value '.$sessionValue;
            $sessionValue = self::checkInput($sessionValue);
            $_SESSION['user'][$sessionKey]  = $sessionValue;
            
        }
        
    }
    
    /**
     * VERIFICATION / CONVERSION DES ENTREES INPUT
     */
    public static function checkInput($data) {
        // var_dump($data);
        if(is_numeric($data)) {

            return intval($data);
            
        } else {
            
            return htmlspecialchars($data);
            
        }
    }

    /**
     * VERIFICATION ADMINISTRATEUR
     */
    public static function admin() : bool {
        
        if($_SESSION['user']['admin']) {

            return true;
            
        } else {
            
            return false;
            
        }
    }

    

}