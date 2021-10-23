<?php 
namespace App\core;

use \PDO;

error_reporting(E_ALL);   // Activer le rapport d'erreurs PHP

function getmicrotime()

{

list($usec, $sec) = explode(" ",microtime());

return ((float)$usec + (float)$sec);

}


$Date_start = getmicrotime();
/**
 * CONNEXION BDD
 */
class Connect {
    
    const HOST      = '';
    const DB_NAME   = '';
    const USER      = '';
    const PASSWORD  = '';
    
    /**
     * CONNEXION A LA BDD
     */
    public function connexion() {
        
        $pdo = new PDO('mysql:host='.self::HOST.';dbname='.self::DB_NAME, self::USER, self::PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;

    }

}
