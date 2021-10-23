<!-- SECTION REGISTER  -->
<section class="register container">

    <!-- Si il n'y a pas d'erreur, j'affiche succès lors de la connexion -->            
    <?php if(empty($messages['success'])) : ?>

    <!-- TITRE -->
    <h1>Inscription</h1>


    <div class="wrapper-right">

        <img src="./assets/img/undraw_authentication.png" alt="Undraw authentication photo">

        <form action="index.php?p=register" method="post">

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

            <!-- LOGIN  -->
            <label for="login">Choisissez un nom d'utilisateur</label>
            <input type="text" class="form-control" id="login" name="login" placeholder="Nom d'utilisateur">
            
            <!-- MOT DE PASSE  -->
            <label for="password">Mot de passse</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">

            <!-- CONFIRMATION MOT DE PASSE  -->
            <label for="password2">Confirmer le mot de passe</label>
            <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirmez mot de passe">
            
            <!-- EMAIL  -->
            <label for="mail">Votre email</label>
            <input type="text" class="form-control" id="mail" name="mail" placeholder="Votre mail" required>

            <button type="submit" id="form-submit">S'enregistrer</button>
            
            <a href="index.php?p=login">Déja inscrit? Connecter vous ici!</a>
        </form>
    </div>

    <!-- Si l'inscription s'est bien passée, j'affiche la box success  -->
    <div class="succes-box">
        <?php else : ?>
            <!-- Si il n'y a pas d'erreur, j'affiche succès lors de la connexion --> 
            <p><?= $messages['success'][0] ?></p>
            <a class="btn-small" href="index.php">Retourner a l'accueil</a>
            <a class="btn-small" href="index.php?p=login">Se connecter</a>
        <?php endif; ?>
    </div>

</section>

