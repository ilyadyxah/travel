$(document).ready(function () {
    $('[data-id=buttonFindPlaces]').click(function (e) {
        let cityId = $("[data-id=city] option:selected").val();

        $.ajax({
            url: '/trips/',
            method: 'get',
            dataType: 'html',
            data: {
                cityId: cityId,
            },
            success: function (data) {
                $(".listing").html(data);
            },
            error: function () {
                alert('чёто не так');
            }
        });
    });
});
