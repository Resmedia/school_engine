<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 17.08.19
 * Time: 18:36
 */
$copy = ' © Copyright Company';
$rights = 'All rights reserved';
$menu = getBdItems('menu', 'position', 'ASC');
?>

<footer class="footer">
    <div class="content">
        <ul class="nav">
            <?php foreach ($menu as $item): ?>
                <?php if (!$item['parent_id'] && $item['status'] == STATUS_PUBLISHED): ?>
                    <li class="nav__item">
                        <a class="nav__link" href="<?= $item['url'] ?>">
                            <?= $item['name'] ?>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <div class="copyright">
            <div class="copyright__left">
                <?= $copy ?>
            </div>
            <div class="copyright__right">
                <?= $rights ?>
            </div>
        </div>
    </div>
</footer>
