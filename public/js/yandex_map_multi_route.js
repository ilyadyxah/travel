ymaps.ready(function () {

    $(".btn-close-route").click(function () {
        console.log(1);
        var id = $(this).getAttribute('name');
        console.log(id);
    })

    var myMap = new ymaps.Map('routes', {
        center: [55.751574, 37.573856],
        zoom: 9,
        controls: ['routeButtonControl']
    });

    //Получаем координаты всех путешествий
    var coordinates = [];
    $(".place-coords").each(function () {
        var latitude = $(this).find("input:first-child").val();
        var longitude = $(this).find("input:last-child").val();
        coordinates.push([latitude, longitude]);
    });

    coordinates.sort(function (a, b) {
        var coordA = a[0]*a[0] + a[1]*a[1];
        var coordB = b[0]*b[0] + b[1]*b[1];
        return coordA - coordB;
    })

    console.log(coordinates);
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
})
;
