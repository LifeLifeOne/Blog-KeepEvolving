import Animation from './class/Animation.js';
import Form from './class/Form.js';
import Ajax from './class/Ajax.js';
import Gsap from './class/Gsap.js';
import Quote from './class/QuoteApi.js';
import Observer from './class/Observer.js';



// Instanciation des classes Javascript
const animationClass = new Animation();
const formClass = new Form();
const observer = new Observer();
const randomQuote = new Quote();
const ajax = new Ajax();
const icon = new Gsap();


// Une fois le DOM chargé, je lance mes fonctions
document.addEventListener('DOMContentLoaded', () => {

    // Invocation fonction qui affiche une pensée positive aléatoire
    if(document.getElementById('positive-api')){
        randomQuote.displayQuote();
    }

    // Invocation de la fonction qui permet le "slide" et les animations du menu en version mobile
    animationClass.navSlide();

    // Invocation du rafraichissement du bouton "Haut de page"
    animationClass.refreshButtonToTop();

    // Invocation de la fonction qui permet de revenir en haut de page en cliquant sur la fleche
    animationClass.goToTop();

    if(document.querySelector('.display-articles')) {
        // Invocation de la fonction API intersection Observer ( Animation opacité des articles)
        observer.observer();
    }

    if(document.getElementById('btn-admin')) {
        // Invocation de la fonction qui affiche/cache le formulaire d'ajout d'articles
        formClass.hideForm();
    }
    
    // Evenement sur le scroll de la page
    document.addEventListener('scroll', () => {
            
        // Fonction qui permet d'éviter l'apparition de l'élement au chargement de la page
        animationClass.refreshButtonToTop();

    });

    // Demande la confirmation avant de supprimer un article
    if(document.querySelector('.admin-dashboard')) {

        const deleteButtons = document.querySelectorAll('.btn-del');

        for (const button of deleteButtons) {

            button.addEventListener('click', () => {    

                if(!confirm('Confirmer la suppression ?')) {

                    button.removeAttribute('href');
                    document.location.reload();
                }

            });

        }

    }

    // CHAT BOX 
    if(document.querySelector('.mini-chat')) {

        // J'affiche directement les messages de la chat box au chargement de la page Chat
        ajax.recupAjaxMessages();

        // TOUCHE ENTREE POUR ENVOYER LE MESSAGE
        function submitOnEnter(event){
            if(event.key === 'Enter'){

                event.target.form.dispatchEvent(new Event("submit", {cancelable: true}));
                event.preventDefault();
            }
        }
        
        document.getElementById("content").addEventListener("keypress", submitOnEnter);
        
        document.getElementById("submit-chat").addEventListener("submit", (event) => {

            event.preventDefault();

        });
        
        // Je raffraichi les messages tous les "x" secondes..
        setInterval(() => {
            ajax.recupAjaxMessages();
        }, 3500);

        document.forms['addMessageForm'].addEventListener('submit', event =>{
        
            event.preventDefault();
        
            const form = document.addMessageForm;
            
            const message = {
                
                name : form.login.value,
                content : form.content.value
                
            }
        
            ajax.addMessage(message);
            document.forms['addMessageForm'].reset();
            
        })
    
    }

    // GSAP SCROLLTRIGGER
    if(document.querySelector('.skills')) {
        
        icon.iconAnimation();

    }
    
});




