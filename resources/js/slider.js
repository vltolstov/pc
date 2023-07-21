/*

    * слайдер
    * листает с плавным появлением элементы в контейнере .face

*/

if(document.querySelector('.slider')){

    const banner = document.querySelector('.slider');
    const countOfSlides = banner.childElementCount;

    for (let i = 0; i < countOfSlides; i++) {
        banner.children[i].style.display = 'none';
        banner.children[i].style.opacity = 0;
    }

    function pause(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    async function slider() {

        let index = 0;

        while (index < countOfSlides + 1) {

            if(index > 0) {
                banner.children[index - 1].style.display = 'none';
                banner.children[index - 1].style.opacity = 0;
            }

            if (index <= countOfSlides - 1) {
                banner.children[index].style.display = 'block';
                banner.children[index].style.opacity = 1;
                index++;
                await pause(6000);
            } else {
                banner.children[index - 1].style.display = 'none';
                banner.children[index - 1].style.opacity = 0;
                index = 0;
            }
        }

    }

    slider();

}




