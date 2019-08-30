const catalogArea = $('#catalog');
const cartTotalPrice = $('.total-price');
const cartBlock = $('.cart-block');
const cartCount = $('.count-cart');


catalogArea.click(data => {
    if(data.target.id = 'add-cart'){
        const id = data.target.dataset.id;
        $.ajax({
            method: 'post',
            url: '/api/add-to-cart',
            data: {
                id: +id,
            }
        }).done(data => {
            let element = JSON.parse(data);
            console.log(element);
            let count = 0;
            let price = 0;
            for (let i = 0; i < element.length; i++) {
                count += element[i].count;
                price += element[i].count * element[i].price
            }
            cartCount.html(count);
            cartTotalPrice.html(price)
        })
    }
});

clearCart = () => {
    $.ajax({
        method: 'post',
        url: '/api/clear-cart',
    }).done(() => {
        let count = 0;
        let price = 0;
        cartCount.html(count);
        cartTotalPrice.html(price)
    })
};