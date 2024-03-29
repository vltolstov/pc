/*
*
*
* Добавление инпутов для загрузки нескольких картинок
*
*
* */

const images = document.querySelector('.images');
const solutionImage = document.querySelector('.solution-image');
let lastIndex = 0;
const addImagesButton = document.querySelector('.add-images-button');

if(images){
    lastIndex = images.childElementCount;
    addImagesButton.addEventListener('click', addImage);
    images.addEventListener('click', delImage);
}

if(solutionImage){
    solutionImage.addEventListener('click', delImage);
}

function addImage() {
    lastIndex++;

    let imageBlock = document.createElement('div');
    imageBlock.classList.add('bord');
    imageBlock.classList.add('image-' + lastIndex);

    let imageDelButton = document.createElement('div');
    imageDelButton.classList.add('del-button');
    imageDelButton.innerHTML = '<span class="icon-exit"></span>';

    let newImageInput = document.createElement('input');
    newImageInput.type = 'file';
    newImageInput.name = 'image-' + lastIndex;

    imageBlock.appendChild(imageDelButton);
    imageBlock.appendChild(newImageInput);
    images.appendChild(imageBlock);
}

function delImage(event) {
    let target = event.target;

    if (target.tagName === 'SPAN') {
        target.parentNode.parentNode.remove();
    }

}
