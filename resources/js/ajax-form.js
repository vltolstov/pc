let overlay = document.querySelector('.overlay');
let exitButton = document.querySelector('.exit-button');
let requestButton = document.querySelector('.request-button');

function formActivate() {
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
    let title = document.querySelector("input[name='title']").value;
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
                requestButton.innerHTML = '<p>Запрос успешно отправлен</p>';
                requestButton.classList.add('modal-result');
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

if(requestButton){
    requestButton.addEventListener('click', formActivate);
}
overlay.addEventListener('click', function (event) {
    let target = event.target;
    if(target.className == 'form-wrap'){
        formActivate();
    }
});
exitButton.addEventListener('click', formActivate);
document.querySelector('.ajaxFormButton').addEventListener('click', submitForm);
