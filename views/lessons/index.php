<?php

use app\models\Lessons;
use app\models\UsersLessons;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\LessonsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Уроки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lessons-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'pager'        => [
            'class' => \app\widgets\pager\Pagination::class,
        ],
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Заголовок',
                'value' => function (Lessons $model) {
                    return $model->title;
                }
            ],
            [
                'label' => 'Статус',
                'value' => function (Lessons $model) {
                    $userLesson = UsersLessons::find()->where(['lesson_id' => $model->id])->one();
                    if (!$userLesson) {
                        return '';
                    }
                    return '✅';
                }
            ],
            [
                'label' => '',
                'format' => 'html',
                'value' => function (Lessons $model) {
                    return Html::a('К уроку', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']);
                }
            ],
        ],
    ]); ?>

    <?php if (UsersLessons::find()->count() == Lessons::find()->count()) { ?>
        <div class="alert alert-success" role="alert">
            Поздравляем вы прошли весь курс!
        </div>
    <?php } ?>
</div>
