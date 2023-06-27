/*
*
*
* Добавление полей комплексного решения если создается категория
*
*
* */

if(document.querySelector('.complete-solution')){
    let form = document.forms.create;
    let category = form.elements.category;
    let completeSolution = document.querySelector('.complete-solution');

    console.log(category.value);

    if(category.value == 0){
        completeSolution.classList.add('hide');
    }

    category.addEventListener("change", (event) => {
        completeSolution.classList.toggle('hide');
    });
}
