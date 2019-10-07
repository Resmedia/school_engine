<h2>Корзина</h2><hr>
<div id="basket" class="row">
    <? foreach ($products as $item): ?>
        <div class="col-4" id="<?= $item['id_basket'] ?>">
            <h2><?=$item['name']?></h2>
            <p>Цена:<?=$item['price']?></p>
            <button data-id="<?= $item['id_basket']?>" class="delete">Удалить</button>
        </div>
    <? endforeach; ?>
</div>
<br/>
<br/>
<?php if(!empty($products)): ?>
<div id="order-form">
    <hr>
    <h2>Оформление заказа</h2>
    <div class="form-group">
        <label for="order-name">Ваше ФИО</label>
        <input type="text" class="form-control" id="order-name" placeholder="Введите ФИО">
    </div>
    <div class="form-group">
        <label for="order-phone">Ваш телефон</label>
        <input type="text" class="form-control" id="order-phone" placeholder="Введите телефон">
    </div>
    <div class="form-group">
        <label for="order-address">Адрес доставки</label>
        <input type="text" class="form-control" id="order-address" placeholder="Введите адрес">
    </div>
    <div class="form-group">
        <label for="order-email">Email для связи</label>
        <input type="email" class="form-control" id="order-email" placeholder="Введите email">
    </div>
    <div class="form-group">
        <label for="order-description">Заметки</label>
        <textarea type="text" class="form-control" id="order-description" placeholder="Введите заметки"></textarea>
    </div>
    <div class="help-block"></div>
    <button id="order-submit" type="submit" class="btn btn-primary">Создать заказ</button>
</div>
<?php endif;?>
<br><br><br><br><br><br>
<script>
    let orderSubmit = $('#order-submit');
    let orderForm = $('#order-form');
    let orderEmail = $('#order-email');
    let orderName = $('#order-name');
    let orderPhone = $('#order-phone');
    let orderAddress = $('#order-address');
    let orderDescription = $('#order-description');
    let helpBlock = $('.help-block');
    let basket = $('#basket');

    orderName.on('input', () => orderName.removeClass('is-invalid'));
    orderPhone.on('input', () => orderPhone.removeClass('is-invalid'));
    orderAddress.on('input', () => orderAddress.removeClass('is-invalid'));

    orderSubmit.on('click', () => {
        if(!orderName.val()) {
            orderName.addClass('is-invalid');
        }
        if(!orderAddress.val()) {
            orderAddress.addClass('is-invalid');
        }
        if(!orderPhone.val()) {
            orderPhone.addClass('is-invalid');
        }
        if(!orderName.val()  || !orderAddress.val() || !orderPhone.val()) {
            helpBlock.html('Поля Телефон, ФИО и Адрес обязательны');
            return false;
        } else {
            helpBlock.html('');
            orderName.removeClass('is-invalid');
            orderAddress.removeClass('is-invalid');
            orderPhone.removeClass('is-invalid');

            $.ajax({
                url: '/Api/Order/',
                method: 'POST',
                headers: new Headers({
                    'Content-Type': 'application/json'
                }),
                data: {
                    email: orderEmail.val(),
                    name: orderName.val(),
                    phone: orderPhone.val(),
                    address: orderAddress.val(),
                    description: orderDescription.val(),
                    goods: <?= json_encode($products) ?>
                }
            }).then(data => {
                newData = JSON.parse(data);
                if(newData.status) {
                    basket.html(`Спасибо! Ваш заказ № ${newData.order_id} успешно сформирован!`);
                    orderForm.html('');
                }
            })
        }
    })
</script>
<script>
    let buttons = document.querySelectorAll('.delete');

    buttons.forEach(elem => {
        elem.addEventListener('click', () => {
            let id = elem.getAttribute('data-id');
            (async () => {
                const response = await fetch('/Api/RemoveFromBasket/', {
                    method: 'POST',
                    headers: new Headers({
                        'Content-Type': 'application/json'
                    }),
                    body: JSON.stringify({
                        id: id
                    }),
                });
                const answer = await response.json();
                document.getElementById('count').innerText = answer.count;
                document.getElementById(id).remove();
            })();
        })
    });
</script>
