

<!-- Si Utilisateur connecté ET qu'il à un role d'admin alors j'affiche le formulaire -->
<?php if(!empty($_SESSION['user']) && $_SESSION['user']['admin']) : ?>

<!-- Bouton qui permet d'afficher/cacher le formulaire d'ajout d'articles -->
<button id="btn-admin">Ajouter un article</button>

<!-- SECTION AJOUT D'ARTICLE  -->
<section class="publish-article container">
    <strong>Ajouter un article</strong>

    <div class="wrapper-right">

        <img src="./assets/img/undraw_Publish_article.png" alt="Undraw authentication photo">

        <form enctype="multipart/form-data" action="index.php?p=blog" method="post">

            <!-- Code PHP qui affiche les erreurs en cas de mauvaise saisie dans le formulaire -->   
            <div class="error-box">
                <?php  if(!empty($messages['errors'])){  ?>
                    
                        <ul>
                        <?php foreach($messages['errors'] as $error):  ?>    
                            <li><i class="fas fa-times"></i> <?=  $error ?></li>
                        <?php endforeach ?>    
                        </ul>
                    
                <?php   }  ?>
            </div>
            
            <!-- TITRE  -->
            <label for="title">Titre de l'article</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Titre de l'article">
        
            <!-- CONTENU  -->
            <label for="content">Contenu</label>
            <textarea id="content" class="textarea-article" name="content" placeholder="Contenu de l'article"></textarea>
        
            <!-- SELECTION CATEGORIES  -->
            <label for="category">Catégorie</label>
            <select class="form-control" id="category" name="category">
                <option value="html">HTML</option>
                <option value="css">CSS</option>
                <option value="javascript">JAVASCRIPT</option>
                <option value="php">PHP</option>
                <option value="mysql">MYSQL</option>
                <option value="framework">FRAMEWORK</option>
                <option value="divers" selected>DIVERS</option>
            </select>
            
            <!-- CHOISIR UNE PHOTO  -->
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
            <input type="file" class="form-control-file" id="photo" name="photo">
                
            <!-- BOUTON SUBMIT  -->
            <button type="submit" id="form-submit">Publier</button>
                
        </form>
    </div>
    
</section>
<?php endif; ?>


<!-- AFFICHAGE DES ARTICLES PUBLIES  -->
<section class="display-articles container">
    <h1>Articles sur le Developpement Web</h1>
        <hr>

        <!-- J'affiche mes articles avec une boucle 'foreach' dans une balise article -->
        <?php foreach($articles as $article) : ?>
        <article class="articles">

            <!-- Si il y a une image, je l'affiche -->
            <?php if(isset($article['img'])) : ?> 
                <img class="article-img img-size" src="./assets/img/articles_photo/<?= htmlspecialchars($article['id']) ?>/<?= htmlspecialchars($article['img']) ?>" alt="image <?= htmlspecialchars($article['img']) ?>">
            <?php endif; ?>
            
            <h2 class="article-title"><?= htmlspecialchars($article['title']) ?></h2>
            <p class="article-category">Catégorie: <span class="color-category"><?= htmlspecialchars($article['category']) ?></span></p>

            <pre class="article-content"><?= htmlspecialchars($article['content']) ?></pre>
            <p class="article-date"><small>Publié le <em><?= htmlspecialchars($article['publication_date']) ?></em> par <b><?= htmlspecialchars($article['login'])?></b></small></p>

        </article>
        <?php endforeach; ?>
        
        <!-- PAGINATION ARTICLES BLOG -->
        <nav class="pagination">
            <ul class="flex">

                <li class="btn-pagination <?= ($currentPage == 1) ? 'disabled' : '' ?>">
                    <a title="Page Précédente" href="index.php?p=blog&page=<?= $currentPage - 1 ?>"><i class="fas fa-chevron-left"></i></a>
                </li>

                <?php for($page = 1; $page <= $pages; $page++): ?>

                    <li>
                        <a title="Page <?= $page ?>" href="index.php?p=blog&page=<?= $page ?>" class="<?= ($currentPage == $page) ? 'current-page' : '' ?>"><?= $page ?></a>
                    </li>

                <?php endfor; ?>

                <li class="btn-pagination <?= ($currentPage == $pages) ? 'disabled' : '' ?>">
                    <a title="Page Suivante" href="index.php?p=blog&page=<?= $currentPage + 1 ?>"><i class="fas fa-chevron-right"></i></a>
                </li>

            </ul>
        </nav>
</section>




