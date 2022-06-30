function changeAttribute(el, attribute)
{
    if(el.tagName === 'LABEL'){
        el = document.getElementsByName(el.getAttribute('for'))[0];
    }
    el.toggleAttribute(attribute)

}
