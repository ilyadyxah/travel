function updateComment(el, action){
    let id;
    let message ;
    let valuesToUpdate = {};
    if (action === 'update'){
         id = el.getAttribute('comment-save');
         message = document.getElementById(id);
         valuesToUpdate = {message: message.value};
    } else if (action === 'delete'){
        id = el.getAttribute('comment-delete');
        message = document.getElementById(id);
        valuesToUpdate = {status_id: 0};
    }
        el.firstElementChild.remove();
        el.style.pointerEvents='none';
        el.innerHTML = '<i class="fa-regular fa-clock"></i>';
        sendPut('/my/comments/' + id, valuesToUpdate).then((result) => {
            console.log(result);
            if(result.status.toString() === 'message'){
                //обновляю дату
                message.parentElement.parentElement.getElementsByTagName('small')[0].innerText = getDateString(new Date(result.instance.updated_at));
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
            }
            else if(result.status === 'invalid'){
                //возвращаю текст комментария
                message.value = result.instance.message;
                let errors = [];
                Object.keys(result.messages).forEach(key => {
                    const value = result.messages[key]
                    errors.push(value.join(', '));
                });
                let errorText = errors.join('; ');
                let alert = document.createElement('div');
                alert.className = "position-absolute";
                alert.innerHTML = `<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><i class="fa-solid fa-triangle-exclamation"></i></strong>` + errorText + `<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`;
                message.parentElement.append(alert);
                setTimeout(()=> {
                    el.innerHTML = '<i class="fa-solid fa-floppy-disk"></i>';
                    el.style.pointerEvents='auto';
                }, 2000);

            }
            else if(result.status === 'error'){
                // вывожу ошибку
                let alert = document.createElement('div');
                alert.className = "position-absolute";
                alert.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="fa-solid fa-triangle-exclamation"></i></strong>` + result.messages + `<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`;
                message.parentElement.append(alert);
                setTimeout(()=> {
                    el.innerHTML = '<i class="fa-solid fa-floppy-disk"></i>';
                    el.style.pointerEvents='auto';
                }, 2000);
            }
            else if(result.status.toString() === 'status_id'){
                if(result.instance.status.title === 'deleted'){
                    el.innerHTML = '<i class="fa-solid fa-trash-can"></i>'
                    el.parentElement.style.pointerEvents='auto';
                    el.parentElement.parentElement.getElementsByTagName('small')[0].innerText = getDateString(new Date(result.instance.updated_at));
                } else {
                    el.parentElement.parentElement.getElementsByTagName('small')[0].innerText = 'Удален пользователем';

                    el.innerHTML = '<i class="fa-solid fa-trash-arrow-up"></i>';
                    el.parentElement.style.pointerEvents='none';
                }
                el.style.pointerEvents='auto';
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
        body: JSON.stringify(data)
    });
    return await response.json();
}

function getDateString(date){
    let month = date.getMonth() > 9 ? (date.getMonth() + 1)  : '0' + (date.getMonth() + 1);
    let day = date.getDate() > 9 ? (date.getDate())  : '0' + (date.getDate());
    return (day + '-' + month + '-' + date.getFullYear());

}
