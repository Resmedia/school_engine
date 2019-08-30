const catalogArea = $('#catalog');
const cartTotalPrice = $('.total-price');
const addCartBtn = $('#add-cart');
const cartBlock = $('.cart-block');
const cartCount = $('.count-cart');
const totalCountPage = $('#total-page-count');
const totalPricePage = $('#total-page-price');

// TODO refactoring double code
addCartBtn.on('click', data => {
    const id = data.target.dataset.id;
    $.ajax({
        method: 'post',
        url: '/api/add-to-cart',
        data: {
            id: +id,
        },
        beforeSend: () => {
            $('#loader').show();
        },
        complete: () => {
            $('#loader').hide();
        },
    }).done(data => {
        let element = JSON.parse(data);
        let count = 0;
        $.each(element, (key, value) => {
            count += value.count;
        });
        cartCount.html(count);
    })
});

catalogArea.click(data => {
    if(data.target.id = 'add-cart'){
        const id = data.target.dataset.id;
        $.ajax({
            method: 'post',
            url: '/api/add-to-cart',
            data: {
                id: +id,
            },
            beforeSend: () => {
                $('#loader').show();
            },
            complete: () => {
                $('#loader').hide();
            },
        }).done(data => {
            let element = JSON.parse(data);
            let count = 0;
            $.each(element, (key, value) => {
                count += value.count;
            });
            cartCount.html(count);
        })
    }
});

clearCart = () => {
    $.ajax({
        method: 'post',
        url: '/api/clear-cart',
        beforeSend: () => {
            $('#loader').show();
        },
        complete: () => {
            $('#loader').hide();
        },
    }).done(() => {
        cartCount.html(0);
        cartTotalPrice.html(0);
        cartBlock.html('');
        totalCountPage.html(0);
        totalPricePage.html(0);
    })
};

removeCartItem = id => {
    $.ajax({
        method: 'post',
        url: '/api/remove-from-cart',
        data: {
            id: +id,
        },
        beforeSend: () => {
            $('#loader').show();
        },
        complete: () => {
            $('#loader').hide();
        },
    }).done(data => {
        let element = JSON.parse(data);
        let count = 0;
        let price = 0;
        cartBlock.html('');
        $.each(element, (key, value) => {
            console.log(value);
            count += +value.count;
            price += +value.price * value.count;
            cartBlock.append(renderCartItems(value));
        });
        cartCount.html(count);
        totalCountPage.html(count);
        totalPricePage.html(price);
    })
};

renderCartItems = item => `
<div class="cart-item">
    <div class="item-info">
        <img class="item-img" alt="${item.name}"
             src="/gallery_img/small/${item.image}"/>
        <div class="item-settings">
            <div class="settings-name">
                ${item.name}
            </div>
            <div class="settings-name">
                <b>Цена за шт:</b> ${item.price} руб.
            </div>
            <div class="settings-name">
                <b>Количество:</b> ${item.count} шт.
            </div>
        </div>
    </div>
    <div class="remove">
        <span onclick="removeCartItem(${item.id})"> &times; </span>
    </div>
</div>
`;