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

/*

    Раскрытие таблицы продуктов в подкатегориях

 */

const productsWrap = document.querySelector('.products-wrap');
const productsOpenButton = document.querySelector('.products-open-button');

function productsTrigger(e) {
    e.preventDefault();
    productsWrap.classList.remove('products-wrap-close');
    productsOpenButton.remove();
}

if(productsOpenButton){
    productsOpenButton.addEventListener('click', productsTrigger);
}
