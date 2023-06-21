/*

    Раскрытие офферов на главной странице

 */

const offersWrap = document.querySelector('.offers-wrap');
const offersOpenButton = document.querySelector('.offers-open-button');

function offersTrigger(e) {
    e.preventDefault();
    offersWrap.classList.remove('offers-wrap-close');
    offersOpenButton.remove();
}

if(offersOpenButton){
    offersOpenButton.addEventListener('click', offersTrigger);
}

