/**
 * CLASSE ANIMATION VANILLA JAVASCRIPT
 */
export default class Animation {
    
    constructor() {
        this.goTop = document.querySelector('.go-top');
    }
    


    /**
     * Fonction pour le slide du menu en version mobile 
     */
    navSlide() {

        // Déclaration constantes pour la navigation burger
        const burger = document.querySelector('#burger');
        const nav = document.querySelector('#nav');

        // Déclaration constantes pour les liens de la navigation burger
        const navLinks = document.querySelectorAll('nav ul li')
    
        burger.addEventListener('click', () => {
    
            // Toggle NAV
            nav.classList.toggle("nav-active");
    
            // LINKS Animation
            navLinks.forEach((link, index) => {
    
                if (link.style.animation) {
                    link.style.animation = '';
                } else {
                    link.style.animation = `navLinkFade 0.2s ease forwards ${index / 9 + 0.1}s`;
                }
        
            });
    
            // Burger Animation
            burger.classList.toggle('toggle-burger');
    
        });
        
    };

    /**
    * Fonction pour l'element permettant de revenir en haut de page
    */
    goToTop() {
        
        this.goTop.addEventListener('click', () => {
    
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
    
        });
        
    };

    /**
     * Fonction pour faire disparaitre / Réapparaître le bouton "Go to top"
     */
    refreshButtonToTop() {
    
        if (document.documentElement.scrollTop <= 150) {
            this.goTop.style.display = 'none';
        } else {
            this.goTop.style.display = 'block';
        }

    };

};