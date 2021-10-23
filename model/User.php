<?php 

namespace App\model;

use App\core\Connect;

class User extends Connect{

    protected $_pdo;
    
    
    public function __construct() {
        
        $this->_pdo = $this->connexion();
    }
    
    /**
     * INSERT UN NOUVEL UTILISATEUR
     */
    public function addUser($login,$password,$mail) {
        
        
        $password = password_hash($password, PASSWORD_DEFAULT); // je hash mon mot de passe 
        
        $sql = "INSERT INTO `user`( `login`, `password`, `mail`) 
                VALUES (:login,:password,:mail)";

        $query = $this->_pdo->prepare($sql);
        $query->execute([
                ':login' => $login,
                ':password' => $password,
                ':mail' => $mail
        ]);
        
    }
    

    /**
     * RECUPERE LES UTILISATEURS AVEC LE CHAMP MAIL
     */
    public function recupUser($mail) {
        
        $sql = "SELECT `id`, `login`, `password`, `mail`, `creation_date`, `admin`
                FROM `user` 
                WHERE mail = :mail";

        $query = $this->_pdo->prepare($sql);
        $query->execute([
                ':mail' => $mail
            ]);
            
        return $query->fetch(\PDO::FETCH_ASSOC); 
        
    }
    
} 