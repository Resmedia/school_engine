<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 24.08.19
 * Time: 23:26
 */

// TODO make it all close fore all people, open only for registered users

class FeedBackMessage
{
    public $messages;
    public $model;
    public $id;

    public function messages()
    {
        return '
        <div class="feedback-form">
        <div class="alert">' . $this->messages->message . '</div>

        <h5>Оставить отзыв</h5>
        <div id="feedback-form">
            <input id="model-type" title="" hidden type="text" value="' . $this->model . '" data-attribute-name="Model TYPE">
            <input id="model-id" title="" hidden type="text" value="' . $this->id . '" data-attribute-name="Model ID">
            <input id="item-id" title="" hidden type="text" data-attribute-name="ID"><br>
            <input id="item-user" class="form-control" data-attribute-name="имя" placeholder="Имя" type="text"><br>
            <textarea id="item-text" class="form-control" data-attribute-name="текст" placeholder="Отзыв"></textarea><br>
            <button
                    id="item-button"
                    class="btn btn-success pull-right"
                    type="submit"
            >
                Отправить
            </button>
        </div>
    </div>

    <div id="feedback" class="messages">
        <img id="loader" class="loader" src="/img/loader.svg"/>
        ' . $this->renderItems($this->messages) . '
    </div>
    <br>';
    }

    private function renderItems($messages)
    {
        $items = [];
        foreach ($messages->items as $message){
            $message = (object)$message;
            if ($message->time_create !== $message->time_update) {
                $time = 'Изменен: ' . date('d.m.Y в H:i', $message->time_update);
            } else {
                $time = 'Создан: ' . date('d.m.Y в H:i', $message->time_create);
            }

            $items[] = '
            <div class="message-item">
                <div class="item-top">
                    <div class="top-name">
                        ' . $message->user .'
                    </div>
                    <div class="top-actions">
                        <a class="btn btn-default btn-xs" type="button" href="#feedback-form" onclick="editMessage('. $message->id . ')">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <button class="btn btn-default btn-xs" onclick="removeMessage(' . $message->id . ')">
                            <i class="fa fa-remove"></i>
                        </button>
                    </div>
                </div>
                <div class="item-body">
                    ' . $message->text . '
                    <div class="body-date">
                        ' . $time . '
                    </div>
                </div>
            </div> ';
        }

        return implode(" ", $items);
    }
}