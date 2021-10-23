<?php 

namespace App\model;

use App\core\Connect;

class Article extends Connect{

    protected $_pdo;
    
    public function __construct(){
        
        $this->_pdo = $this->connexion();

    }

    
    /**
     *  INSERT UN NOUVEL ARTICLE 
     */
    public function addArticle($title, $content, $photo, $category, $userId) {
    
        // requete 
        $sql = 'INSERT INTO 
                    article(title, content, img, category, user_id) 
                VALUES 
                    (:title,:content,:photo,:category,:userId)';
        $query = $this->_pdo->prepare($sql);
        $query->execute([
            ':title'    => $title,
            ':content'  => $content,
            ':photo'    => $photo,
            ':category' => $category,
            ':userId'   => $userId
            ]);
            
        return $this->_pdo->lastInsertId();
        
    }


    /**
     *  RECUPERE LES ARTICLES
     */
    public function recupArticles(int $offset, int $perPage) {

        $sql = 'SELECT 
                    article.id, title, content, img, category, login, DATE_FORMAT(publication_date, "%d/%m/%Y à %Hh%i") as publication_date
                FROM 
                    article 
                INNER JOIN 
                    user
                ON 
                    article.user_id = user.id 

                ORDER BY article.id DESC 
                
                LIMIT :offset, :perPage;'; 

        $query = $this->_pdo->prepare($sql);

        $query->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $query->bindValue(':perPage', $perPage, \PDO::PARAM_INT);

        $query->execute();
        
        return $query->fetchAll(\PDO::FETCH_ASSOC);
            
    }


    /**
     *  RECUPERE LE NOMBRE TOTAL D'ARTICLES
     */
    public function totalArticles() {
        
        $sql = 'SELECT COUNT(*) AS nb_articles FROM article;';
        $query = $this->_pdo->prepare($sql);
        $query->execute();
        
        return $query->fetch(\PDO::FETCH_ASSOC);
            
    }


    /**
     *  RECUPERE LES ARTICLES PAR LE CHAMP "id"
     */
    public function recupArticlebyId($id) {
    
        /* récuperation d'un article  */
        $sql = 'SELECT 
                    article.id, `title`, `content`, `img`, `category`, `login`, DATE_FORMAT(publication_date, "%d/%m/%Y") as `publication_date`
                FROM `article` 
                INNER JOIN `user`
                ON article.user_id = user.id
                WHERE article.id = :id
                ORDER BY article.id DESC';
                    
        $query = $this->_pdo->prepare($sql);
        $query->execute([
            ':id' => $id
            ]);
        
        return $query->fetch(\PDO::FETCH_ASSOC);
        
    }
    

    /**
     * MODIFIER LES ARTICLES
     */
    public function updateArticle($id,$title,$content,$category) {
    
        /* récuperation d'un article  */
        $sql = 'UPDATE article 
                SET 
                    `title`= :title,
                    `content`= :content,
                    `category`= :category,
                    `publication_date`= NOW() 
                WHERE id = :id';

        $query = $this->_pdo->prepare($sql);
        $query->execute([
            ':title' => $title,
            ':content' => $content,
            ':category' => $category,
            ':id' => $id
            ]);
        
        return "L'article à bien été modifié";
    }
    

    /**
     * SUPPRESSION DES ARTICLES
     */
    public function deleteArticleBdd($id) {
    
        /* suppression d'un article  */
        $sql = 'DELETE FROM article
                WHERE id = :articleId';

        $query = $this->_pdo->prepare($sql);
        $query->execute([
            ':articleId' => $id
            ]);
        
    }
    
}
