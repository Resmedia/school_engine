<?php
$year = date('Y');
$month = strftime('%B');
$day = date('d');
$date = new DateTime();
$hour = (int)$date->format('H');
$welcome = '';

if ($hour > 0 && $hour < 6) {
    $welcome = 'Доброй ночи!';
} elseif ($hour >= 6 && $hour < 12) {
    $welcome = 'Доброе утро!';
} elseif ($hour >= 12 && $hour < 18) {
    $welcome = 'Добрый день!';
} elseif ($hour >= 18 && $hour < 23) {
    $welcome = 'Добрый вечер!';
};

$text = '<p class="text-center"> Время:' . $date->format(' H:i') . '<br /> <h3 class="text-center">' . $welcome . '</h3></p>';
$name = 'Evgenii Rogozhuk';
$desc = 'This is home work lesson 4';
?>
<h1 class="text-center">
    <?= $name ?>
</h1>
<h2 class="text-center">
    <?= $desc ?>
</h2>
<p>
<p class="text-center">
    Сейчас <?= $year ?: '' ?> год, <?= $day ?: ''?> <?= $month ?: '' ?>
    <?= $text ?: '' ?>
</p>

