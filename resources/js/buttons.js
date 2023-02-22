/*

    Раскрытие офферов на главной странице

 */


const offersWrap = document.querySelector('.offers-wrap');
const offersOpenButton = document.querySelector('.offers-open-button');
const offersLink = document.querySelector('.offers-link');

function offersTrigger(e) {
    e.preventDefault();
    offersWrap.classList.remove('offers-wrap-close');
    offersOpenButton.remove();
}

offersOpenButton.addEventListener('click', offersTrigger);
