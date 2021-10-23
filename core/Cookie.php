<?php 

namespace App\core;

class Cookie{
    
    /**
     * DESTRUCTION DES COOKIES
     */
    public static function deleteCookie(array $cookies) :void {
        
        foreach($cookies as $cookieKey => $cookieValue) {
            
            setcookie($cookieKey);                                                
            unset($_COOKIE[$cookieKey]);
            
        }
        
    }
    

    /**
     * CREATION DES COOKIES
     */
    public static function setCookies(array $cookies) :void {
        
        foreach($cookies as $cookieName => $cookieValue) {
            
            setcookie($cookieName,$cookieValue,time()+365*24*3600);
    
        }
        
    }
        

    /**
     * VERIFICATION DES COOKIES
     */
    static function checkCookie(string $cookieName) :void {
        
        if(array_key_exists($cookieName,$_COOKIE)) {
                                                            
            echo "value='".$_COOKIE[$cookieName]."'";
                                                            
        }
        
    }
    
}