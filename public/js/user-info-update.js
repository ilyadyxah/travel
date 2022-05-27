function userInfoUpdate(data) {

    userInfoSend('/my/info/' + data).then((result) => {
        buttonUpdate(result.length, data + '-btn');

    })

}
async function userInfoSend(url)
{

    let response = await fetch(url, {
        method: 'GET',
    });
    return await response.json();
}

function buttonUpdate(total, elementId)
{
    const badge = document.querySelector('#' + elementId);
    if(total === 0) {
        badge.innerText = '';
    } else {
        badge.innerText = total;
    }
}
