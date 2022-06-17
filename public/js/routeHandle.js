function routeHandle(route) {
    const id = route.getAttribute('route');
    route.style.pointerEvents='none';
    route.firstElementChild.remove();
    route.innerHTML = '<i class="fa-regular fa-clock"></i>';
    placeRouteSend('/route/' + id).then((result) => {
        route.firstElementChild.remove();
        if(result.state === 'addRoute') {
            route.innerHTML = '<p style="cursor: pointer">добавить в маршрут</p>';
        }
        else if(result === 'max') {
                route.innerHTML = '<p style="cursor: pointer">достигнут максимум</p>';
        } else{
            route.innerHTML = '<p style="cursor: pointer">удалить из маршрута</p>';
        }
        route.style.pointerEvents='auto';
    })

}
async function placeRouteSend(url)
{

    let response = await fetch(url, {
        method: 'GET',
    });
    if (response.ok) {
        return await response.json();
    }
    return 'max'
}
