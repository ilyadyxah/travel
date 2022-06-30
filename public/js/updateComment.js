function updateComment(el){
    let id = el.getAttribute('comment-save');
    let message = document.getElementById(id);
    el.firstElementChild.remove();
    el.style.pointerEvents='none';
    el.innerHTML = '<i class="fa-regular fa-clock"></i>';
    sendPut('/my/comments/' + id, message.value).then((result) => {
        if(result.status === 'true'){
            let date = new Date(result.instance.updated_at)
            let month = date.getMonth() > 9 ? (date.getMonth() + 1)  : '0' + (date.getMonth() + 1)
            //обновляю дату
            message.parentElement.parentElement.getElementsByTagName('small')[0].innerText = date.getDate() + '-' + month + '-' + date.getFullYear();
            //меняю классы и аттрибуты
            changeAttribute(message, 'disabled');
            toggleClassName(message, ['bg-transparent', 'bg-warning']);
            //меняю иконки в обратную сторону
            el.innerHTML = '<i class="fa-solid fa-check"></i>';
            setTimeout(()=> {
                el.innerHTML = '<i class="fa-solid fa-floppy-disk"></i>';
                el.style.pointerEvents='auto';
                toggleClassName(el, ['opacity-0']);

            }, 2000);
        } else if(result.status === 'false'){
            //возвращаю текст комментария
            message.value = result.instance.message;
            Object.keys(result.messages).forEach(key => {
                    const value = result.messages[key]
                let errors = value.join(', ');
                    console.log(errors);

                let alert = document.createElement('div');
                alert.className = "position-absolute";
                alert.innerHTML = `<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><i class="fa-solid fa-triangle-exclamation"></i></strong>` + errors + `<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`;
                message.parentElement.append(alert);
                });
            //меняю классы и аттрибуты
            setTimeout(()=> {
                el.innerHTML = '<i class="fa-solid fa-floppy-disk"></i>';
                el.style.pointerEvents='auto';

            }, 2000);

        } else{
            console.log('error')
        }
    })

}
async function sendPut(url, data){

    let response = await fetch(url, {
        method: 'PUT',
        // mode: 'cors', // no-cors, *cors, same-origin
        // cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
        // credentials: 'same-origin', // include, *same-origin, omit
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                .getAttribute('content'),
            'Content-Type': 'application/json; charset=utf-8',
        },
        // redirect: 'follow', // manual, *follow, error
        // referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
        body: JSON.stringify({message: data})
    });
    return await response.json();
}
