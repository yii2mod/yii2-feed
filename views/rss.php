<?php
use yii\helpers\Html;
use yii\helpers\StringHelper;

?>
<?php

foreach ($items as $item) : ?>
    <li class="rss-post">
        <h2><?php echo Html::a($item->get_title(), $item->get_permalink()); ?> <?php echo $item->get_date('D, d M Y H:i:s'); ?></h2>
        <?php echo StringHelper::truncateWords(strip_tags($item->get_content()), 40); ?>
    </li>
<?php endforeach; ?>