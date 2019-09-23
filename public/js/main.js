let getMoreBtn = $('#get-more');

getMoreBtn.click(() => {
    $.ajax({
        method: 'post',
        url: '/products',
        data: {
            limit: 5,
        }
    }).then(data => {
        //let newData = JSON.parse(data);
        console.log(data)
    })
});