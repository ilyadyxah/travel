function PrivateHandle(user) {
    const id = user.getAttribute('user');
    user.style.pointerEvents='none';
    user.firstElementChild.remove();
    user.innerHTML = '<i class="fa-regular fa-clock"></i>';
    privateSend('/private/' + id).then((result) => {
        user.firstElementChild.remove();
        if(result.is_private){
            user.innerHTML = '<i class="fa-solid fa-lock"></i>';
        } else{
            user.innerHTML = '<i class="fa-solid fa-lock-open"></i>';
        }
        user.style.pointerEvents='auto';
    })

}
async function privateSend(url)
{
    let response = await fetch(url, {
        method: 'GET',
    });
    return await response.json();
}

