<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BARBEAU Vivien - Développeur Web et passionné de nouvelles technologies">

    <!-- Favicon  -->
    <link rel="icon" type="image/png" href="favicon.ico">

    <!-- Titre dynamique PHP  -->
    <title><?= $title ?></title>

    <!-- Importation des fichiers css -->
    <link rel="stylesheet" href="./assets/css/normalize.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    
    <!-- Importation de Font Awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<!-- BODY  -->
<body>

    <!-- ####################### HEADER ####################### -->
    <header>

        <div class="logo">
            <a class="logo-KeepEvolving" href="index.php" title="Logo KeepEvolving">Keep<span class="logo-color">Evolving</span></a>
        </div>

        <!-- Vignette de l'utilisateur connecté  -->
        <?php if(!empty($_SESSION['user'])) : ?>
            <div class="hello-username">
                <span title="Utilisateur connecté"><i class="fas fa-user"></i> <?= $_SESSION['user']['login'] ?></span>
            </div>
        <?php endif; ?>

        <!-- Administrator link  -->
        <?php if(!empty($_SESSION['user']) && $_SESSION['user']['admin']) : ?>
            <div class="administrator">
                <a title="Espace Administrateur" href="index.php?p=admin"><i class="fas fa-unlock-alt"></i></a>
            </div>
        <?php endif; ?>

        <!-- Navigation Bar Hamburger Media queries-->
        <div class="burger" id="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>

        <!-- Navigation Bar -->
        <nav class="container" id="nav">
            
            <ul class="flex">

                <!-- Navigation links -->
                <li <?= $https::active('home')?>><a title="Page d'accueil" href="index.php?p=home">Index</a></li>
                <li <?= $https::active('blog') ?>><a title="Page Blog" href="index.php?p=blog">Blog</a></li>
                
                <!-- Si on est pas connecté ou enregistré -->
                <?php if(empty($_SESSION['user'])) : ?>
                <li <?= $https::active('register') ?>><a title="S'enregistrer" href="index.php?p=register">S'enregistrer</a></li>
                <li <?= $https::active('login') ?>><a title="Connexion" href="index.php?p=login">Connexion</a></li>

                <!-- Si je suis connecté -->
                <?php else : ?>
                <li <?= $https::active('logout') ?>><a title="Déconnexion" href="index.php?p=logout">Déconnexion</a></li>
                <li <?= $https::active('chat') ?>><a title="Accès au chat" href="index.php?p=chat">Salon</a></li>
                <?php endif; ?>
                
                <li <?= $https::active('contact') ?>><a title="Page Contact" href="index.php?p=contact">Contact</a></li>
    
            </ul>

        </nav>

    </header>
    
    <!-- ####################### MAIN ####################### -->              
    <main>

        <!-- Element qui permet de remonter en haut de page -->
        <div class="go-top" title="Haut de page">
            <i class="fas fa-chevron-up"></i>
        </div>

        <!-- LE CHEMIN POUR TOUTES LES VUES -->
        <?php require 'views/'.$path ?>
        
    </main>

    <!-- ####################### FOOTER ####################### -->
    <footer>
        <!-- Div qui regroupe les deux wraps  -->
        <div class="container flex">
            <!-- Div qui regroupe le texte du developpeur -->
            <div class="wrap-creator">
                <span>Site réalisé par <a title="https://vivienbarbeau.com" href="https://vivienbarbeau.com" target="_blank" rel="noreferrer noopener">Vivien BARBEAU</a></span>   
            </div>
            
            <!-- W3C validator -->
            <div class="legal flex-column">
                <div>
                    <a title="Validation W3C" class="w3c" href="http://jigsaw.w3.org/css-validator/validator?uri=http%3A%2F%2Flocalhost%2F">
                        <img src="./assets/img/vcss-blue.gif" alt="Validation W3C">
                    </a>
                </div>
            </div>
            
            <!-- Div qui regroupe les icones -->
            <div class="wrap-icons">
                <ul class= "flex">
                    <li title="GitHub"><a href="https://github.com/LifeLifeOne" target="_blank" rel="noreferrer noopener" aria-label="Github"><i class="fab fa-github"></i></a></li>
                    <li title="Twitter"><a href="https://twitter.com/BRAIN_Vivien" target="_blank" rel="noreferrer noopener" aria-label="Twitter"><i class="fab fa-twitter"></i></a></li>
                    <li title="Linkedin"><a href="https://www.linkedin.com/in/Vivien-Barbeau" target="_blank" rel="noreferrer noopener" aria-label="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                </ul>
            </div>
        </div>
    </footer>
    <!-- Importation fichier APP javascript -->
    <script type="module" src="./assets/js/main.js"></script>

    <!-- Importation Librairie javascrip  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/ScrollTrigger.min.js"></script>
</body>
</html>



