<!-- SECTION LOGIN  -->
<section class="login container">
    
    <!-- Si il n'y a pas d'erreur, j'affiche succès lors de la connexion -->            
    <?php if(empty($messages['success'])) : ?>
    
    <!-- TITRE -->
    <h1>Se connecter</h1>

    <div class="wrapper-left">

        <img src="./assets/img/undraw_access_account.png" alt="Undraw connexion illustration">

        <form action="index.php?p=login" method="post">

            <!-- Code PHP qui affiche les erreurs en cas de mauvaise saisie dans le formulaire -->   
            <div class="error-box">
                <?php  if(!empty($messages['errors'])){  ?>
                    
                        <ul>
                        <?php foreach($messages['errors'] as $error):  ?>    
                            <li><i class="fas fa-times"></i> <?=  $error ?></li>
                        <?php endforeach ?>    
                        </ul>
                    
                <?php    }  ?>
            </div>

            <!-- EMAIL  -->
            <label for="mail">Votre email</label>
            <input type="text" class="form-control" id="mail" name="mail" placeholder="Votre mail" 
            value="<?= $_COOKIE['mail'] ?? ''  ?>" required>
            
            <!-- MOT DE PASSE  -->
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe"
            value ="<?= $_COOKIE['password'] ?? ''  ?>">
            
            <!-- SE SOUVENIR DE MOI  -->
            <label class="form-check-label" for="remember"> Se souvenir de moi </label>
            <input class="form-check-input" type="checkbox" value="true" id="remember" name="remember" checked>
            
            <!-- BOUTON  -->
            <button type="submit" id="form-submit" class="main-button">Se connecter</button>
            
        </form>
    </div>

    <div class="succes-box">
        <?php else : ?>
            <!-- Si il n'y a pas d'erreur, j'affiche succès lors de la connexion -->
            <p><?= $messages['success'][0] ?></p>
            
            <div class="access-connect">
                <!-- Acces Blog  -->
                <div>
                    <a class="btn-small" href="index.php?p=blog">Accès au blog</a>
                    <img src="./assets/img/undraw_blog.png" alt="Undraw blog illustration">
                </div>

                <hr>

                <!-- Acces chat en ligne  -->
                <div>
                    <a class="btn-small" href="index.php?p=chat">Accès au chat</a>
                    <img src="./assets/img/undraw_chatting.png" alt="Undraw blog illustration">
                </div>
            </div>

        <?php endif; ?>
    </div>

</section>

