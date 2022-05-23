function favoriteHandle(favorite) {
    const id = favorite.getAttribute('favorite');
    favorite.style.pointerEvents='none';
    favorite.firstElementChild.remove();
    favorite.innerHTML = '<i class="fa-regular fa-clock"></i>';
    placeLikeSend('/favorite/' + id).then((result) => {
        console.log(result);
        favorite.firstElementChild.remove();
        if(result.state === 'true'){
            favorite.innerHTML = '<i class="fa-solid fa-thumbs-up"></i>';

        } else{
            favorite.innerHTML = '<i class="fa-regular fa-thumbs-up"></i>';
        }
        favorite.style.pointerEvents='auto';
    })

}
async function placeLikeSend(url)
{

    let response = await fetch(url, {
        method: 'GET',
    });
    return await response.json();
}

