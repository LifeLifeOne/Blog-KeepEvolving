/**
 * CLASSE AJAX
 */
export default class Ajax {

    /**
     * AJOUTE LE MESSAGE
     */
    addMessage(message) {

        let box = document.querySelector('.chat-box');
        box.scrollTop = box.scrollHeight;

        const form = new FormData();
        form.append('action', 'addMessage')

        form.append('content', message.content.trim())
        form.append('login', message.name)


        fetch('index.php?ajax=send', { method: 'POST', body: form })
            .then((res) => res.text())
            .then((data) => {

                document.querySelector('.checkMessage').innerHTML = data
                setTimeout(() => {

                    document.querySelector('.checkMessage').innerHTML = '';

                }, 1200);

            })
            .catch((err) => {

                console.log(err)
                document.querySelector('.chat-box ul').innerHTML = "=( Désolé, une erreur s'est produite...";

            })
    }


    /**
     * RECUPERE LES MESSAGES DE LA BDD ET LES AFFICHE
     */
    recupAjaxMessages() {

        let box = document.querySelector('.chat-box');
        const ul = document.querySelector('.chat-box ul');

        box.scrollTop = box.scrollHeight;

        fetch('index.php?ajax=recupMessages')
            .then((res) => res.json())
            .then((data) => {

                let output = '';

                data.forEach((info) => {

                    output += `
                            <li><span class="login-color">${info.login}</span> : ${info.content}</li>
                        `;

                })

                ul.innerHTML = output;

            })
            .catch((err) => {

                console.log(err)
                document.querySelector('.chat-box ul').innerHTML = "=( Désolé, une erreur s'est produite...";

            });


    }

}