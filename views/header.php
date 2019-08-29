<?php

$result = '<nav class="top-nav content">';
$result .= '<ul class="nav">';
$result .= renderMenu(getBdItems('menu', 'position', 'ASC'));
$result .= '</ul>';
$result .= '</nav>';
?>

<header class="header">
    <?= $result; ?>
</header>

