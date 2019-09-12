let form = $('#feedback-form');
let messages = $('.messages');
let alert = $('.alert');
let hiddenId = $('#item-id');
let user = $('#item-user');
let text = $('#item-text');
let button = $('#item-button');
let modelId = $('#model-id');
let modelType = $('#model-type');

like = id => {
    $.ajax({
        url: '/api/like',
        type: 'post',
        data: {
            id,
            element: modelType.val(),
        },
    }).done(data => $('.like-count').html(data))
};

removeMessage = id => {
    if(confirm('Вы уверены что хотите удалить этот отзыв?')){
        send('remove', id);
    }
};

resetForm = () => {
    hiddenId.val('');
    user.val('');
    text.val('');
    button.html('Отправить');
    $('#reset-edit').remove();
};

editMessage = id => {
    $.ajax({
        method: 'post',
        url: '/api/catalog-item',
        beforeSend: () => {
            $('#loader').show();
        },
        complete: () => {
            $('#loader').hide();
        },
        data: {
            id: +id,
        }
    }).done(data => {
        resetForm();
        alert.html('');
        let element = JSON.parse(data);
        for (i = 0; i < element.length; i++){
            hiddenId.val(element[i].id);
            user.val(element[i].user);
            text.val(element[i].text);
            button.html('Редактировать');
            form.append(`<button id="reset-edit" onclick="resetForm()" class="btn btn-success pull-left">Отменить</button>`);
        }
    })
};

button.on('click', e => {
    let action = hiddenId.val() ? 'edit' : 'add';
    if(validate(user) && validate(text)){
        send(action, hiddenId.val(), text.val(), user.val());
        alert.html('');
    }
    e.stopPropagation();
});

send = (action, id = 0, text = '', user = '') => {
    $.ajax({
        method: 'post',
        url: '/api/message',
        beforeSend: () => {
            $('#loader').show();
        },
        complete: () => {
            $('#loader').hide();
        },
        data: {
            action,
            model_id: +modelId.val(),
            id: +id,
            user: user,
            text: text,
            model: modelType.val()
        }
    }).done(data => {
        resetForm();
        let element = JSON.parse(data);
        for (let i = 0; i < element.length; i++){
            $('.feedback-count').html(element[i].items.length);
            alert.append(`<p>${element[i].message}</p>`);
            renderMessages(element[i].items);
        }
    })
};

renderMessages = items => {
    messages.html('');
    for (let i = 0; i < items.length; i++){
        let item = items[i];
        messages.append(`
            <div class="message-item">
                <div class="item-top">
                    <div class="top-name">
                        ${item.user}
                    </div>
                    <div class="top-actions">
                        <a class="btn btn-default btn-xs" type="button" href="#feedback-form" onclick="editMessage('${item.id}')">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <button class="btn btn-default btn-xs" onclick="removeMessage('${item.id}')">
                            <i class="fa fa-remove"></i>
                        </button>
                    </div>
                </div>
                <div class="item-body">
                    ${item.text}
                    <div class="body-date">
                        ${item.time_create !== item.time_update ?
            `Изменен: ${moment.unix(item.time_update).format("L в LT")}` :
            `Создан: ${moment.unix(item.time_create).format("L в LT")}`
            }
                    </div>
                </div>
            </div>
            `)
    }
};

validate = item => {
    alert.html('');
    if(item.val().length <= 0){
        alert.append(`<p>Поле ${item.data('attribute-name')} обязательно к заполнению!</p>`);
        return false;
    }

    return true;
};