/**
 * CLASSE QUOTE
 */
export default class Quote {

    displayQuote() {

        const paragraph = document.querySelector('#positive-api p');

        fetch('https://type.fit/api/quotes')
        .then((res) => res.json())
        .then((data) => {

            let outputFirst = `<q class='quote-style'>${data[Math.floor(Math.random() * 1642)].text}</q>`
            paragraph.innerHTML = outputFirst;
            paragraph.style.animation = "opacityFade 8s infinite";

            setInterval(() => {

                let output = `<q class='quote-style'>${data[Math.floor(Math.random() * 1643)].text}</q>`
                paragraph.innerHTML = output;
                paragraph.style.animation = "opacityFade 8s infinite";

            }, 8000);

        })
        .catch((err) => console.log(err));
    }
    

}