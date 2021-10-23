/**
 * CLASSE FORM
 */
export default class Form {

    /**
     * Methode toggle qui affiche / Cache le formulaire d'ajout d'article
     */ 
    hideForm() {

        const btn = document.querySelector('#btn-admin');
        const sectionForm = document.querySelector('.publish-article');

        btn.addEventListener('click', () => {

            sectionForm.classList.toggle('show');
            
            if(document.querySelector('.show')) {
                btn.textContent = 'Cacher le formulaire';
            } else {
                btn.textContent = 'Ajouter un article';
            }

        })

    }
    
}