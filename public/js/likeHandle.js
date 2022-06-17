function likeHandle(like) {
    const id = like.getAttribute('like');
    like.style.pointerEvents = 'none';
    like.firstElementChild.remove();
    like.innerHTML = '<i class="fa-regular fa-clock"></i>';
    placeLikeSend('/like/' + id).then((result) => {
        like.firstElementChild.remove();
        LikedPlaceUpdate(result.total, 'like-' + id);
        userInfoUpdate('likes');
        if (result.state === 'dislike') {
            like.innerHTML = '<i class="fa-solid fa-thumbs-up"></i>';

        } else {
            like.innerHTML = '<i class="fa-regular fa-thumbs-up"></i>';
        }
        like.style.pointerEvents = 'auto';
    })

}
async function placeLikeSend(url) {

    let response = await fetch(url, {
        method: 'GET',
    });
    return await response.json();
}

function LikedPlaceUpdate(total, elementId) {
    const badge = document.querySelector('#' + elementId);
    if (total === 0) {
        badge.innerText = '';
    } else {
        badge.innerText = total;
    }
}
