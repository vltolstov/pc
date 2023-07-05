
let body = document.querySelector('body');
let title = '';

function formActivate() {
    let overlay = document.querySelector('.overlay');
    overlay.classList.toggle('hide');
}

function submitForm() {

    let bords = document.querySelectorAll('.input-alert');
    if(bords.length !== 0){
        for(let i = 0; i < bords.length; i++){
            bords[i].classList.toggle('input-alert');
        }
    }

    let errorMessages = document.querySelectorAll('.error-message');
    if(errorMessages.length > 0) {
        for (let i = 0; i < errorMessages.length; i++) {
            errorMessages[i].classList.add('hide');
        }
    }

    let name = document.querySelector("input[name='name']").value;
    let imfa = document.querySelector("input[name='imfa']").value;
    let email = document.querySelector("input[name='email']").value;
    let phone = document.querySelector("input[name='phone']").value;
    let comment = document.querySelector("input[name='сomment']").value;
    let token = document.querySelector("meta[name='csrf-token']").content;


    fetch('/sending', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            "X-CSRF-Token": token,
        },
        body: JSON.stringify({
            name: name,
            title: title,
            imfa: imfa,
            email: email,
            phone: phone,
            comment: comment
        })
    })
        .then(response => response.json())
        .then(json => {
            if(json.success === 'ok'){
                formActivate();
                document.querySelector('.modal-form').reset();
                // здесь дописать всплывашку об успешном выполнении
                // requestButton.innerHTML = '<p>Запрос успешно отправлен</p>';
                // requestButton.classList.add('modal-result');
            }
            let errorMessages = document.querySelectorAll('.error-message');
            if(errorMessages.length > 0){
                for(let i = 0; i < errorMessages.length; i++){
                    for(let item in json.errors) {
                        let itemName = item + '-error';
                        if(errorMessages[i].classList.contains(itemName)) {
                            errorMessages[i].classList.remove('hide');
                        }
                    }
                }
            }

            for(let item in json.errors){
                let errorBord = document.querySelector("." + item + "-alert");
                errorBord.classList.toggle('input-alert');
            }
        })
        .catch(errors => console.log(errors));

}

body.addEventListener('click', function (event) {
    if(event.target.parentElement.classList.contains('request-button'))
    {
        title = event.target.parentElement.dataset.title;
        formActivate();
    }
    if(event.target.className == 'form-wrap'){
        formActivate();
    }
});

if(document.querySelector('.exit-button')) {
    document.querySelector('.exit-button').addEventListener('click', formActivate);
}

if(document.querySelector('.ajaxFormButton')){
    document.querySelector('.ajaxFormButton').addEventListener('click', submitForm);
}

