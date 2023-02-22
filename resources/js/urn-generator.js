import slugify from 'slugify';

function updateSlug(){
    let form = document.forms.create;
    let name = form.elements.name;
    form.elements.urn.value = slugify(
        name.value,
        {
            remove: /[ь]/g,
            locale: 'ru',
            strict: true,
            lower: true
    });
}

if(document.querySelector('.name')) {
    document.querySelector('.name').onblur = updateSlug;
}
