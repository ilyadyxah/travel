ymaps.ready(function () {
    var myMap = new ymaps.Map('map', {
        center: [55.753994, 37.622093],
        zoom: 9,
        // Добавление панели маршрутизации на карту.
        controls: ['routePanelControl']
    });

    // Получение ссылки на панель.
    var control = myMap.controls.get('routePanelControl');

    control.routePanel.state.set({
        // Адрес начальной точки.
        from: $('[data-id=city_name]').text(),
        // from: userTextLocation
        // Адрес конечной точки.
        to: '55.753994, 37.622093'
    });

    // Получение объекта, описывающего построенные маршруты.
    var multiRoutePromise = control.routePanel.getRouteAsync();
    multiRoutePromise.then(function(multiRoute) {
        //  Подписка на событие получения данных маршрута от сервера.
        multiRoute.model.events.add('requestsuccess', function() {
            // Ссылка на активный маршрут.
            var activeRoute = multiRoute.getActiveRoute();
            if (activeRoute) {
                var routeData = {
                    'distance': activeRoute.properties.get("distance").text,
                    'duration': activeRoute.properties.get("duration").text
                };
                // Вывод информации об активном маршруте.
                console.log(routeData);
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
