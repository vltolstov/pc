/*
*
*
* Добавление инпутов для ввода параметров страницы (товара, категории, и т.д.)
*
*
* */

let params = document.querySelector('.params');
const addParamsButton = document.querySelector('.add-params-button');


if(params){
    let index = params.childElementCount;
    addParamsButton.addEventListener('click', addParamInput);
    params.addEventListener('click', delParam);
}

function addParamInput() {

    index++;

    let newParamsLine = document.createElement('div');
    newParamsLine.classList.add('params-line');
    newParamsLine.classList.add('row');

    let newParamDelButton = document.createElement('div');
    newParamDelButton.classList.add('del-button');
    newParamDelButton.innerHTML = '<span class="icon-exit"></span>';

    let newParamName = document.createElement('input');
    newParamName.classList.add('col-lg-5');
    newParamName.type = 'text';
    newParamName.name = 'param-name-' + index;
    newParamName.placeholder = 'Параметр';

    let newParamValue = document.createElement('input');
    newParamValue.classList.add('col-lg-4');
    newParamValue.type = 'text';
    newParamValue.name = 'param-value-' + index;
    newParamValue.placeholder = 'Значение';

    let newParamActive = document.createElement('input');
    newParamActive.classList.add('col-lg-1');
    newParamActive.type = 'checkbox';
    newParamActive.name = 'param-active-' + index;
    newParamActive.value = '1';

    let newParamHide = document.createElement('input');
    newParamHide.classList.add('col-lg-1');
    newParamHide.type = 'checkbox';
    newParamHide.name = 'param-hide-' + index;
    newParamHide.value = '1';

    newParamsLine.appendChild(newParamDelButton);
    newParamsLine.appendChild(newParamName);
    newParamsLine.appendChild(newParamValue);
    newParamsLine.appendChild(newParamActive);
    newParamsLine.appendChild(newParamHide);

    params.appendChild(newParamsLine);

}

function delParam(event) {
    let target = event.target;

    if (target.tagName === 'SPAN') {
        target.parentNode.parentNode.remove();
    }

}

