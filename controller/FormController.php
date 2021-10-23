<?php 

namespace App\controller;

use App\model\User;
use App\core\{ Session, Cookie, Https };


class FormController {
    
    protected $_user;
    protected $_article;
    
    public function __construct($user){
        
        $this->_user = $user;

    }

    /**
     * FORM REGISTER
     */
    public function registerForm(array $data) {
        /*var_dump($data,$data['login']);*/
        $messages = [];
        
        // Si tous les champs sont vides alors j'affiche une erreur ...
        if(empty($data['login']) || empty($data['password'])|| empty($data['password2']) || empty($data['mail'])) {
            $messages['errors'][] = "Veuillez remplir tous les champs";
        }


        // Validation du nom d'utilisateur 
        $aValid = array('-', '_');
        if(!ctype_alnum(str_replace($aValid, '', $data['login']))) {
            $messages['errors'][] = "Votre nom d'utilisateur ne peut pas contenir de caractères spéciaux ni d'espace";
        }
        // Validation longueur minimale du nom d'utilisateur
        if(!strlen($data['login']) >= 5) {
            $messages['errors'][] = "Votre nom d'utilisateur doit faire 5 caractères minimum";
        }
    
        // Validation de l'email
        if(!filter_var($data['mail'], FILTER_VALIDATE_EMAIL)) {
            $messages['errors'][] = "L'adresse email est incorrecte ";
        }
    
        // Validation du mot de passe
        if($data['password'] !== $data['password2']) {
            $messages['errors'][] = "Les mots de passe doivent être les mêmes";
        }

        // Validation longueur du mot de passe
        if(strlen($data['password']) < 5) {
            $messages['errors'][] = "Votre mot de passe doit faire au moins 5 caractères";
        }

        $exist = $this->_user->recupUser($data['mail']);
    
        if($exist) {
            $messages['errors'][] = "L'email correspond à un compte déja existant";
        }

        if(empty($messages['errors'])) {
            
            $this->_user->addUser($data['login'],$data['password'],$data['mail']);

            $messages['success'] = ['<span class="success"><i class="fas fa-check"></i>'.' '.'Inscription réussie</span>'];
            
        }
        
        return $messages;
    }


    /**
     * FORM LOGIN
     */
    public function loginForm(array $data) {
        
        // verif 1
        if(empty($data['password']) || empty($data['mail'])){

            $messages['errors'][] = "Veuillez remplir tous les champs";

        } else { 

            $exist = $this->_user->recupUser($data['mail']);
            
            if(!$exist) {

                $messages['errors'][] = "L'email n'existe pas";

            } else if (password_verify($data['password'], $exist['password'])) {  
                
                Session::setUserSession($exist);
                    
                $messages['success'][] = '<span class="success"><i class="fas fa-check"></i>'.' '.'Connexion réussie!</span>';
            
                (isset($data['remember'])) ? Cookie::setCookies($data) : Cookie::deleteCookie($data);

            
            } else {
                
                $messages['errors'][] = 'Le mot de passe est invalide.';
            }
            
        }
        
        return $messages;
            
    }


    /**
     * FORM ARTICLE
     */
    public function articleForm(array $data){
        
        $photo = null;
            
        if(empty($data['title']) 
        || empty($data['content'])) {
            
            $message['errors'][] = "Veuillez remplir tous les champs";
            
        } 
            
        if($data['category'] !== 'html' 
        && $data['category'] !== 'css'
        && $data['category'] !== 'javascript'
        && $data['category'] !== 'php'
        && $data['category'] !== 'mysql'
        && $data['category'] !== 'framework') {
            
            $data['category'] = 'divers';
            
        }
            
        // Partie photo 
        if($_FILES['photo']['error'] === 0) {
            $photo = $_FILES['photo']['name'];
        }

        if(empty($message['errors'])) {
            
            $idArticle = $this->_article->addArticle($data['title'],
                                                     $data['content'],
                                                     $photo,
                                                     $data['category'],
                                                     $_SESSION['user']['id']);
        }  

        if($_FILES['photo']['error'] === 0) {    
        
            $lastId = $idArticle;
            $chemin_dossier = './assets/img/articles_photo';
            
            mkdir($chemin_dossier.'/'.$lastId, 0711);
            move_uploaded_file($_FILES['photo']['tmp_name'], $chemin_dossier.'/'.$lastId.'/'.$photo);
        }
            
        if(empty($message['errors'])) {
            
            Https::redirect('index.php?p=blog');
            
        } else {
            
            return $message;
            
        }
            
    }
    
    /**
     * ENVOI L'ARTICLE
     */
    public function setArticle($article){
        
        $this->_article = $article;
        
    }
    
};