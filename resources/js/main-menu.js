let body = document.querySelector('body');
let menuItems = ['catalog', 'engineering', 'portfolio', 'company'];
let mainMenuItems = document.querySelector('.main-menu-container').children;
let lastIndex = '';

body.addEventListener('click', function (event) {

    menuItems.forEach(element => {

        if(event.target.className === 'top-menu-' + element){
            event.preventDefault();
            for(let i = 0; i < mainMenuItems.length; ++i){
                if(!mainMenuItems[i].classList.contains('hide')){
                    mainMenuItems[i].classList.add('hide');
                }
            }
            document.querySelector('.main-menu-' + element).classList.remove('hide');
            document.querySelector('.main-menu').classList.remove('hide');
        }

    });

});

body.addEventListener('mouseover', function (event) {
    if(event.target.dataset.itemId){

        if(event.target.dataset.itemId !== lastIndex){
            document.querySelectorAll('.right-submenu-flex').forEach(element => {
                if(!element.classList.contains('hide')){
                    element.classList.add('hide');
                }
            })
        }

        let selector = '.menu-id-' + event.target.dataset.itemId;
        let subMenuItem = document.querySelector(selector);
        if(subMenuItem.classList.contains('hide')){
            subMenuItem.classList.toggle('hide');
            lastIndex = event.target.dataset.itemId;
        }
    }
});

if(document.querySelector('.main-menu-exit-button')) {
    document.querySelector('.main-menu-exit-button').addEventListener('click', () => {
        document.querySelector('.main-menu').classList.add('hide');
    });
}
