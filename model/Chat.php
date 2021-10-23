<?php 

namespace App\model;

use App\core\Connect;

class Chat extends Connect{

    protected $_pdo;
    
    public function __construct(){
        
        $this->_pdo = $this->connexion();

    }

    /**
     * INSERTION DU MESSAGE DANS LA TABLE MESSAGE
     */
    function sendMessage($content, $idUser) {

        $messages = [];

        if(!empty($content) && $content !== false) {

            $content = htmlspecialchars($content);

            $sql='INSERT INTO 
                    message (content, id_user) 
                VALUES (:content, :id)';

            $query = $this->_pdo->prepare($sql);
            $query->execute([
                    ':content' => $content,
                    ':id' => $idUser
                    ]);

            return $messages['success'][] = "<span class='success'>Envoi du message...</span>";

        } else {

            return $messages['errors'][] = "<span class='error'>Message vide...</span>";
            
        }

    }

    /**
     * RECUPERATION DES MESSAGES DE LA TABLE MESSAGE
     */
    function recupMessages() {

        $sql='SELECT 
                message.id, content, login, DATE_FORMAT(publication_date, "%Hh%i:%ss") as publication_date 
            FROM 
                message 
            INNER JOIN 
                user 
            ON 
                message.id_user = user.id
            ORDER BY 
                message.id DESC
            LIMIT
                25';
                
        $query = $this->_pdo->prepare($sql);
        $query->execute();
        
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        
        return array_reverse($result);

    }

}