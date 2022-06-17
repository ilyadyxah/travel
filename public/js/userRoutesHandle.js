ymaps.ready(function () {

    renderMap();

    $(".btn-close-route").click(function () {
        var id = $(this).attr('name');
        deleteRoute('/route/delete/' + id).then((result) => {
            if (result.state === 'success') {
                $("[data-id=place_" + id + "]").remove();
                $('#routes').html('');
                renderMap();
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
