
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
                new Toast({
                    title: false,
                    text: 'Успешно отправлено',
                    theme: 'success',
                    autohide: true,
                    interval: 3000
                });
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




/**
 * Toast (https://github.com/itchief/ui-components/tree/master/toast)
 * Copyright 2020 - 2021 Alexander Maltsev
 * Licensed under MIT (https://github.com/itchief/ui-components/blob/master/LICENSE)
 **/

class Toast {
    constructor(params) {
        this._title = params['title'] === false ? false : params['title'] || 'Title';
        this._text = params['text'] || 'Message...';
        this._theme = params['theme'] || 'default';
        this._autohide = params['autohide'] && true;
        this._interval = +params['interval'] || 5000;
        this._create();
        this._el.addEventListener('click', (e) => {
            if (e.target.classList.contains('toast__close')) {
                this._hide();
            }
        });
        this._show();
    }
    _show() {
        this._el.classList.add('toast_showing');
        this._el.classList.add('toast_show');
        window.setTimeout(() => {
            this._el.classList.remove('toast_showing');
        });
        if (this._autohide) {
            setTimeout(() => {
                this._hide();
            }, this._interval);
        }
    }
    _hide() {
        this._el.classList.add('toast_showing');
        this._el.addEventListener('transitionend', () => {
            this._el.classList.remove('toast_showing');
            this._el.classList.remove('toast_show');
            this._el.remove();
        }, {
            once: true
        });
        const event = new CustomEvent('hide.toast', {
            detail: {
                target: this._el
            }
        });
        document.dispatchEvent(event);
    }
    _create() {
        const el = document.createElement('div');
        el.classList.add('toast');
        el.classList.add(`toast_${this._theme}`);
        let html = `{header}<div class="toast__body"></div><button class="toast__close" type="button"></button>`;
        const htmlHeader = this._title === false ? '' : '<div class="toast__header"></div>';
        html = html.replace('{header}', htmlHeader);
        el.innerHTML = html;
        if (this._title) {
            el.querySelector('.toast__header').textContent = this._title;
        } else {
            el.classList.add('toast_message');
        }
        el.querySelector('.toast__body').textContent = this._text;
        this._el = el;
        if (!document.querySelector('.toast-container')) {
            const container = document.createElement('div');
            container.classList.add('toast-container');
            document.body.append(container);
        }
        document.querySelector('.toast-container').append(this._el);
    }
}
