<section class="mini-chat container">

    <h1>Salon de discussion</h1>
    <p>Ici, vous pouvez discuter de tout et de rien, partager de bon liens pour continuer la quête d'apprentissage.</p>
    
    <!-- Div contenant ma chat box  -->
    <div id="scroll" class="chat-box">
        <ul><!--Les messages récupérés en ajax --></ul>
    </div>

    <!-- si la personnes est connectée j'affiche le formulaire -->
    <?php if(array_key_exists('user',$_SESSION)) : ?>
    
        <!--Boite d'envoi du message-->
        <form name="addMessageForm">
            
            <!-- INPUT INVISIBLE RECUP LOGIN  -->
            <input type="hidden" name="login" id='login' value='<?= $_SESSION['user']['id'] ?>'/>

            <!-- MESSAGE  -->
            <div class="flex-column">
                <label for="content">Votre message:</label>
                <textarea name="content" id="content"></textarea>
                
                <!-- Message d'érreur/succès  -->
                <span class="checkMessage"></span>
                
                <!-- BOUTON  -->
                <input class="btn-small" id="submit-chat" type="submit" value="Envoyer" />
                
            </div>
            
        </form>  
    
    <?php else : ?>
        
		<a class="btn-small" href="index.php?p=login"><i class="fas fa-arrow-circle-right"></i> Se connecter</a>

    <?php endif; ?>

</section>