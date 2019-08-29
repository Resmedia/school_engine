<?php

$result = '<nav class="top-nav content">';
$result .= '<ul class="nav">';
$result .= renderMenu(getBdItems('menu'));
$result .= '</ul>';
$result .= '</nav>';
?>

<header class="header">
    <?= $result; ?>
</header>

