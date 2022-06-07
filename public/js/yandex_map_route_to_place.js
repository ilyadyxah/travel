ymaps.ready(function () {
    //Получаем координаты из компонента по id
    let startLatitude = document.getElementById("start_latitude").innerHTML
    let startLongitude = document.getElementById("start_longitude").innerHTML
    let endLatitude = document.getElementById("end_latitude").innerHTML
    let endLongitude = document.getElementById("end_longitude").innerHTML

    // Пролучение элемента для вывода деталей маршрута(продолжительность и расстояние)
    let routeDescription = document.getElementById("route_description")

    var myMap = new ymaps.Map('map', {
        center: [+endLatitude, +endLongitude],
        zoom: 9,
        // Добавление панели маршрутизации на карту.
        controls: ['routePanelControl'],
    });


    // Получение ссылки на панель.
    var control = myMap.controls.get('routePanelControl');

    control.routePanel.state.set({
        // Адрес начальной точки.
        from: [+startLatitude, +startLongitude],
        // Адрес конечной точки.
        to: [+endLatitude, +endLongitude]
    });

    // Получение объекта, описывающего построенные маршруты.
    var multiRoutePromise = control.routePanel.getRouteAsync();
    multiRoutePromise.then(function (multiRoute) {
        //  Подписка на событие получения данных маршрута от сервера.
        multiRoute.model.events.add('requestsuccess', function () {
            // Ссылка на активный маршрут.
            var activeRoute = multiRoute.getActiveRoute();
            if (activeRoute) {
                var routeData = {
                    'distance': activeRoute.properties.get("distance").text,
                    'duration': activeRoute.properties.get("duration").text
                };
                // Вывод информации об активном маршруте.
                console.log(routeData);
                routeDescription.innerHTML = `<p class="text_description">Дистанция маршрута: ${routeData.distance} </p>
                <p class="text_description">Продолжительность маршрута: ${routeData.duration} </p> `
            }
        });
        multiRoute.options.set({
            // Цвет метки начальной точки.
            wayPointStartIconFillColor: "#B3B3B3",
            // Цвет метки конечной точки.
            wayPointFinishIconFillColor: "blue",
            // Внешний вид линий (для всех маршрутов).
            routeStrokeColor: "00FF00"
        });
    }, function (err) {
        console.log(err);
    });
});
