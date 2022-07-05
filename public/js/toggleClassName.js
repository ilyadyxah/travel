function toggleClassName(el, classNameArray)
{
    if(el.tagName === 'LABEL'){
        el = document.getElementsByName(el.getAttribute('for'))[0];
    }
    classNameArray.forEach(className => {
        el.classList.toggle(className);

})
}
