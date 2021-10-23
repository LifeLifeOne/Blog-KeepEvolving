<?php 

namespace App\controller;

use App\controller\FormController;
use App\model\{ User, Article };
use App\core\{ Session, Https, Cookie };


class FrontController {

    /**
     * FONCTION RENDER 
     */
    public function render(string $path, $array = []) {

        extract($array);
            
        $session = new Session;
        $https   = new Https;

        $path = $path.".php";
        require 'template/template.php';
        
    }
    
    /**
     * HOME PAGE
     */
    public function home() {

        $title = "KeepEvolving - Home";
        $this->render('index/home', ['title' => $title]);
    
    }
    
    /**
     * BLOG PAGE
     */
    public function blog() {

        if(isset($_GET['page']) && !empty($_GET['page'])) {
            // Sécurisation contre les injections dans le paramètre d'url 
            $currentPage = (int) strip_tags($_GET['page']) ? (int) strip_tags($_GET['page']) : 1;
        } else {
            $currentPage = 1;
        }

        // Total des articles dans la BDD
        $total = new Article();
        $totalArticles = $total->totalArticles();
        $nbArticles = (int) $totalArticles['nb_articles'];

//-->var_dump('total articles: '.$nbArticles.'<br>');

        $perPage = 4;
        $pages = ceil($nbArticles / $perPage);

//-->var_dump('total pages: '.$pages.'<br>');

        // Si la page courante est supérieur au nombre de pages totales alors la page courante sera égale à la page 1
        $currentPage = ($currentPage > $pages) ? 1 : $currentPage;

//-->var_dump('Page actuelle: '.$currentPage.'<br>');
            
        $offset = ($currentPage * $perPage) - $perPage;

        $article  = new Article();
        $articles = $article->recupArticles($offset, $perPage);

        if($_POST) {
            
            $form   = new FormController(new User());
            $form->setArticle($article);
            $messages = $form->articleForm($_POST);   
            
        }

        $title = "KeepEvolving - Blog";
        $this->render('blog/blogView', ['title' => $title,
                                        'articles' => $articles,
                                        'pages'  => $pages,
                                        'currentPage' => $currentPage]);
    
    }

    /**
     * CHAT/SALON PAGE
     */
    public function chat() {

        ($_SESSION['user']) ? '' : Https::redirect('index.php');

        $title = "Chat Box";
        $this->render('chat/chatView', ['title' => $title]);

    }

    /**
     * UPDATE ARTICLE + UPDATE ARTICLE PAGE
     */
    public function update(){
        
        (Session::admin()) ? '' : Https::redirect('index.php');

        
        if(!array_key_exists('numArticle',$_GET)) {
            Https::redirect('admin/adminDashBoard.php');
        }
        
        $articleModel = new Article();
        $article = $articleModel->recupArticlebyId($_GET['numArticle']);

        if($_POST) {
            
            $up = $articleModel->updateArticle($_POST['numPost'],$_POST['title'],$_POST['content'],$_POST['category']);

            Https::redirect('index.php?p=admin');
            
        }

        $title = "Modifier l'article - KeepEvolving";
        $this->render('admin/updateArticle', ['title' => $title,
                                              'article' => $article]);
        
    }
    
    /**
     * DELETE ARTICLE
     */
    public function deleteArticle() {
        
        (Session::admin()) ? '' : Https::redirect('index.php');
        
        if(!array_key_exists('numArticle',$_GET)) {

            Https::redirect('admin/adminDashBoard.php');
        }
        
        $article = new Article();
        $article->deleteArticleBdd($_GET['numArticle']);

        // supprimer le dossier de l'image 
        array_map('unlink', glob('assets/img/articles_photo/'.$_GET['numArticle'].'/*')); // pour l'image
        rmdir('assets/img/articles_photo/'.$_GET['numArticle']); 

        Https::redirect('index.php?p=admin');

    }
    
    /**
     * REGISTER PAGE
     */
    public function register() {

        if(array_key_exists('user',$_SESSION)) {
            
            Https::redirect('index.php');
            
        }

        if($_POST) {

            $form   = new FormController(new User());
            $messages = $form->registerForm($_POST);
        
        }

        $title = "S'enregistrer - KeepEvolving";
        $this->render('connexion/registerView', ['title' => $title,
                                                 'messages' => ($messages) ?? null,
                                                 'cookie'   => new Cookie ]);
    
    }
    
    /**
     * LOGIN PAGE
     */
    public function login(){

        if(array_key_exists('user',$_SESSION)) {
            
            Https::redirect('index.php');
            
        }

        if($_POST) {

            $form     = new FormController(new User());
            $messages = $form->loginForm($_POST);
        
        }

        $title = "Se connecter - KeepEvolving";
        $this->render('connexion/loginView', ['title' => $title,
                                              'messages' => ($messages) ?? null,
                                              'cookie'   => new Cookie ]);
        
    }

    /**
     * CONTACT PAGE
     */
    public function contact() {

        $title = "Informations Contact - KeepEvolving";
        $this->render('contact/contactView', ['title' => $title]);
    
    }

    /**
     * ADMIN PAGE
     */
    public function admin() {

        (Session::admin()) ? '' : Https::redirect('index.php');

        if(isset($_GET['page']) && !empty($_GET['page'])) {
            // Sécurisation contre les injections dans le paramètre d'url 
            $currentPage = (int) strip_tags($_GET['page']) ? (int) strip_tags($_GET['page']) : 1;
        } else {
            $currentPage = 1;
        }

        // Total des articles dans la BDD
        $total = new Article();
        $totalArticles = $total->totalArticles();
        $nbArticles = (int) $totalArticles['nb_articles'];

        $perPage = 6;
        $pages = ceil($nbArticles / $perPage);

        // Si la page courante est supérieur au nombre de pages totales alors la page courante sera égale à la page 1
        $currentPage = ($currentPage > $pages) ? 1 : $currentPage;

        $offset = ($currentPage * $perPage) - $perPage;

        $article  = new Article();
        $articles = $article->recupArticles($offset, $perPage);

        $title = "Panel administrateur - KeepEvolving";
        $this->render('admin/adminDashBoard', [ 'title' => $title,
                                                'offset' => $offset,
                                                'perPage' => $perPage,
                                                'articles' => $articles,
                                                'pages' => $pages,
                                                'currentPage' => $currentPage]);
    
    }

    /**
     * SESSION LOGOUT 
     */
    public function logout() {
    
        Session::deconnect();
        
        Https::redirect('index.php');
    }

}