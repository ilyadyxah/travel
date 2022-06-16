function routeHandle(route) {
    const id = route.getAttribute('route');
    route.style.pointerEvents='none';
    route.firstElementChild.remove();
    route.innerHTML = '<i class="fa-regular fa-clock"></i>';
    placeRouteSend('/route/' + id).then((result) => {
        route.firstElementChild.remove();
        if(result.state === 'addRoute'){
            route.innerHTML = '<p>добавить маршрут</p>';

        } else{
            route.innerHTML = '<p>удалить маршрут</p>';
        }
        route.style.pointerEvents='auto';
    })

}
async function placeRouteSend(url)
{

    let response = await fetch(url, {
        method: 'GET',
    });
    return await response.json();
}
