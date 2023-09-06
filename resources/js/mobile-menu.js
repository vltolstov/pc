let body = document.querySelector('body');
let mobileMenu = document.querySelector('.mobile-menu');

body.addEventListener('click', function (event) {

    if(event.target.className === 'mobile-catalog'){
        event.preventDefault();
        if(mobileMenu.classList.contains('hide')){
            mobileMenu.classList.remove('hide');
        }
        body.style.overflow = 'hidden';
    }

});

if(document.querySelector('.mobile-menu-exit-button')) {
    document.querySelector('.mobile-menu-exit-button').addEventListener('click', () => {
        document.querySelector('.mobile-menu').classList.add('hide');
        body.style.overflow = 'scroll';
    });
}
