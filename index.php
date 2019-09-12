<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 12.09.19
 * Time: 8:52
 */

$owner = 'Evgenii Rogozhuk';
$lesson = 'PHP 2 Lesson 1 Home Work';
?>
<html>
<head>
    <title>
        <?= $owner ?: '' . ' - ' . $lesson ?: '' ?>
    </title>
    <style>
        body{
            font-size: 18px;
        }
        .red {
            color: red;
            margin-right: 10px;
        }
        .new-price{
            color: green;
        }
        .text-center{
            text-align: center;
        }
        .wrap{
            max-width: 900px;
            margin: 5% auto;
        }
        pre{
            color: #4080a5;
        }
    </style>
</head>
<body>

<div class="wrap">
    <h1 class="text-center">
        <?= $owner ?: ''?>
    </h1>
    <h2 class="text-center">
        <?= $lesson ?: ''?>
    </h2>
    <b>
        1. Придумать класс, который описывает любую сущность, автотранспорт, интернет-магазин (корзина, товар), персонаж,
        приведите пример использования, создайте экземпляры.<br/>
        2. Описать свойства класса из п.1 (состояние).<br/>
        3. Описать поведение класса из п.1 (методы).<br/>
        4. Придумать наследников класса из п.1. <br/>
        Чем они будут отличаться?<br/>
    </b>
    <br/>
    <?php
    /**
     * @class Phone
     * @description This class for Phone for shop
     * @property string $manufacture Phone manufacture
     * @property string $model Phone model
     * @property string $color Phone color
     * @property string $size Phone size
     * @property string $memory Phone disc size
     * @property int $count count of phones to bye
     * @property int $price Price of one phone
     */
    class Phone {
        public $manufacture;
        public $model;
        public $color;
        public $size;
        public $memory;
        public $count = 0;
        public $price = 0;

        /**
         * @name aboutInfo
         * @param int $discount Add new price
         * @return string what user bye with total price and count
         */
        public function aboutInfo(int $discount = 0): string
        {
            return 'Вы выбрали телефон марки ' .
                $this->manufacture . ', модель ' .
                $this->model . ', цвет ' .
                $this->color . ', c памятью в ' .
                $this->memory . ' GB в количестве ' .
                $this->count . 'шт. Итого: ' . ($discount ? '<s class="red">' . number_format(self::getPrice(), 2, '.', ' ') .
                    'руб. </s>  Новая цена: <span class="new-price">' .
                    number_format($discount * $this->count, 2, '.', ' ') .
                    ' руб.</span>' : number_format(self::getPrice(), 2, '.', ' ') . ' руб');
        }

        /**
         * @name getPrice
         * @return int total price
         */
        private function getPrice(): int
        {
            return $this->count * $this->price;
        }
    }
    /**
     * @name PhoneWithDiscount
     * @description This class add discount to phone
     * @property int $discount Phone % discount
     */
    class PhoneDiscount extends Phone {

        public $discount = 0;

        /**
         * @name calculateDiscount
         * @description this function for discount calculation
         * @return string of discount calculation price and put it to parent class Phone in function aboutInfo
         */
        public function discountAboutInfo()
        {
            return $this->aboutInfo($this->price - ($this->price * $this->discount / 100));
        }
    }

    $phone = new Phone;

    $phone->manufacture = 'iPhone';
    $phone->model = 'XR';
    $phone->memory = '64';
    $phone->color = 'Space Gray';
    $phone->count = 2;
    $phone->price = 70000;

    echo '<b>Вариант без скидки: </b>' . $phone->aboutInfo() . '<br/> <br/>';

    $iPhone = new PhoneDiscount;

    $iPhone->manufacture = 'iPhone';
    $iPhone->model = 'XS';
    $iPhone->memory = '32';
    $iPhone->color = 'Rose';
    $iPhone->count = 4;
    $iPhone->price = 85000;

    $iPhone->discount = 11; // discount 11%

    echo '<b>Вариант со скидкой: </b>' . $iPhone->discountAboutInfo() . '<br/>';
    echo 'Ваша скидка составила ' . $iPhone->discount . '% <br/>';

    ?>
    <br/>
    <em>
        Создано 2 класса "телефон" и "наследник" телефон со скидкой. При вызове класса просто "телефон" нет расчета скидки,
        а если вызвать класс "телефон со скидкой" и указать ее, то будет произведен расчет и вывод информации с учетом
        новой стоимости и скидки;
        <br/>
        <br/>
        P.S. Понятно, что данные классы в таком варианте использоваться не будут, пример сделан для наглядности объмена
        информацией между классами
    </em>
    <br/>
    <br/>
    <br/>
    <b>5. Дан код:</b>
    <pre>
        class A {
           public function foo() {
             static $x = 0;
             echo ++$x;
           }
        }

        $a1 = new A();
        $a2 = new A();

        $a1->foo();
        $a2->foo();
        $a1->foo();
        $a2->foo();
    </pre>

    <b>Что он выведет на каждом шаге? Почему?</b>
    <?php
    class A {
        public function foo() {
            static $x = 0;
            echo ++$x;
        }
    }

    $a1 = new A();
    $a2 = new A();

    echo $a1->foo();
    echo $a2->foo();
    echo $a1->foo();
    echo $a2->foo();
    ?>

    Немного изменим п.5:
    class A {
    public function foo() {
    static $x = 0;
    echo ++$x;
    }
    }
    class B extends A {
    }
    $a1 = new A();
    $b1 = new B();
    $a1->foo();
    $b1->foo();
    $a1->foo();
    $b1->foo();
    6. Объясните результаты в этом случае.
    7. *Дан код:
    class A {
    public function foo() {
    static $x = 0;
    echo ++$x;
    }
    }
    class B extends A {
    }
    $a1 = new A;
    $b1 = new B;
    $a1->foo();
    $b1->foo();
    $a1->foo();
    $b1->foo();
    Что он выведет на каждом шаге? Почему?

</div>

</body>
</html>
