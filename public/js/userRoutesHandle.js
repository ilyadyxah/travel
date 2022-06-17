ymaps.ready(function () {
    var alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'K'];

    function getCoordinates() {
        //Получаем координаты всех путешествий
        var coordinates = [];
        $(".place-table-item").each(function () {
            var id = $(this).attr('id');
            var latitude = $(this).find("input:first-child").val();
            var longitude = $(this).find("input:last-child").val();
            coordinates[id] = [id, latitude, longitude];
        });

        coordinates.sort(function (a, b) {
            var coordA = a[1]*a[1] + a[2]*a[2];
            var coordB = b[1]*b[1] + b[2]*b[2];
            return coordA - coordB;
        })

        return coordinates;
    }

    function placeMarks (coordinates) {
        $('.place-table-item').each(function () {
            var id = $(this).attr('id');
            var index = coordinates.findIndex(item => item['0'] === id);
            $(this).find('.point-name').text('Метка - ' + alphabet[index]);
        })
    }

    renderMap(getCoordinates());
    placeMarks(getCoordinates());

    $(".btn-close-route").click(function () {
        var id = $(this).attr('name');
        deleteRoute('/route/delete/' + id).then((result) => {
            if (result.state === 'success') {
                $(`#${id}`).remove();
                $('#routes').html('');
                renderMap(getCoordinates());
                placeMarks(getCoordinates())
            }
        })
    })

    async function deleteRoute(url) {
        let response = await fetch(url, {
            method: 'GET',
        });
        return await response.json();
    }
});
