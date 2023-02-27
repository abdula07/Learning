<?php
/**
 * @var \yii\web\View $this
 * @var int $page
 * @var int $total
 * @var int $pageCount
 * @var int $pageSize
 */


use app\common\helpers\Url;
use yii\helpers\Html;
use app\common\helpers;

$map = [
    1 => 1,
    $pageCount => $pageCount,
];

for ($i = $page-2; $i< $page+3; $i++) {
    $map[$i] = $i;
}



?>
<div class="data-pagintation animated">
    <?php
    for ($i = 0; $i < $pageCount; $i++) {
        if (!isset($map[$i+1])) {
            if (isset($map[$i])) {
                echo Html::tag('span', '...');
            }
            continue;
        }
        if ($page == $i + 1) {
            echo Html::tag('span', $i + 1, ['class' => 'current']);
            continue;
        }
        echo Html::a($i + 1, Url::SetParam(\Yii::$app->request->url, ['page' => ($i == 0 ? null : $i + 1)]));
    }
    ?>
</div>
