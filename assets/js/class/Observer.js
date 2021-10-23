/**
 * CLASSE OBSERVER
 */
export default class Observer {

    observer() {

        let observer = new IntersectionObserver(observables => {

            for(let observable of observables) {

                if(observable.intersectionRatio > 0.2) {
                    observable.target.classList.remove("hiddenObs");
                } else {
                    observable.target.classList.add("hiddenObs");
                }

            }

        }, { threshold: [0.2]}); 

        const articles = document.querySelectorAll('article');

        for(let article of articles) {
            article.classList.add("hiddenObs");
            observer.observe(article);
        }

    }

}