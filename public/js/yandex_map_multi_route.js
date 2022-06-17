function renderMap(coordinates) {

    var myMap = new ymaps.Map('routes', {
        center: [55.751574, 37.573856],
        zoom: 9,
        controls: ['routeButtonControl']
    });

    coordinates.forEach(function (item) {
        item.splice(0, 1);
    })

// Создание экземпляра маршрута.
    var multiRoute = new ymaps.multiRouter.MultiRoute({
        // Точки маршрута.
        // Обязательное поле.
        referencePoints: coordinates
    }, {
        // Автоматически устанавливать границы карты так,
        // чтобы маршрут был виден целиком.
        boundsAutoApply: true
    });

// Добавление маршрута на карту.
    myMap.geoObjects.add(multiRoute);
}

