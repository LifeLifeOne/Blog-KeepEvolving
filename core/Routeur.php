<?php 
namespace App\core;
use App\core\Https;
use App\controller\FrontController;
use App\model\{Article, Chat};


class Routeur {
    
    /**
     * Routeur 
     */
    public static function routeur()  {
    
        $routeur = new FrontController();

        // PAGE ROUTER
        if(isset($_GET['p'])) {
            
            $method = $_GET['p'];
            
            (method_exists(FrontController::class, $method)) ? $routeur->$method() : $routeur->home();

        // AJAX   
        } else if(array_key_exists('ajax',$_GET)) {
        
            if(isset($_POST['action'])) {

                $msg = new Chat();
                $message = $msg->sendMessage($_POST['content'],$_POST['login']);
                echo $message;
                
            };

            if($_GET['ajax'] == 'recupMessages') {
                
                $message = new Chat();
                $messages = $message->recupMessages();
                echo json_encode($messages);
                
            };
        
        // REDIRECTION
        } else {

            Https::redirect('index.php?p=home');

        }
            
    } 
    
}