
<!-- SECTION AJOUT D'ARTICLE  -->
<section class="Publish-article container">
    <h3>Modifier l'article <?= htmlspecialchars($article['id'])?></h3>

        <!-- Code PHP qui affiche les erreurs en cas de mauvaise saisie dans le formulaire -->
        <div class="error-box">
            <?php if(empty($messages['success'])) : ?>

            <?php  if(!empty($messages['errors'])){  ?>
                <ul>
                <?php foreach($messages['errors'] as $error):  ?>    
                    <li><i class="fas fa-times"></i> <?=  $error ?></li>
                <?php endforeach ?>    
                </ul>
            <?php      }  ?>
            <?php endif; ?>
        </div>

    <div class="wrapper-right">
        <img src="./assets/img/undraw_Publish_article.png" alt="Undraw authentication photo">

        <form enctype="multipart/form-data" action="index.php?p=update&numArticle=<?= htmlspecialchars($article['id']) ?>" method="POST">
            
            <!-- ID  -->
            <input type="hidden" name="numPost" value="<?= htmlspecialchars($article['id']) ?>">

            <!-- TITRE  -->
            <label for="title">Titre de l'article</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Titre" value="<?= htmlspecialchars($article['title']) ?>" required>
        
            <!-- CONTENU  -->
            <label for="content">Contenu</label>
            <textarea id="content" class="textarea-article" name="content" required><?= htmlspecialchars($article['content']) ?></textarea>
        
            <!-- SELECTION CATEGORIES  -->
            <label for="category">Catégorie</label>
            <select class="form-control" id="category" name="category">
                <option value="html">HTML</option>
                <option value="css">CSS</option>
                <option value="javascript">JAVASCRIPT</option>
                <option value="php">PHP</option>
                <option value="mysql">MYSQL</option>
                <option value="framework">FRAMEWORK</option>
                <option value="divers">DIVERS</option>
            </select>
            
            <!-- BOUTON SUBMIT  -->
            <button type="submit" id="form-submit">Modifier</button>
                
        </form>
    </div>
</section>


