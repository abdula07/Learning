<?php

use app\models\Lessons;
use app\models\UsersLessons;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Lessons $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Уроки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$nextLesson = Lessons::find()->orderBy(['id' => SORT_DESC])->one();
$url = '?r=lessons/view&id=' . $nextLesson->id;

if ($nextLesson->id == $model->id) {
    $url = '?r=lessons/index';
}

?>
<div class="lessons-view" id="lessons-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'title',
            'description:ntext',
        ],
    ]) ?>

    <iframe class="col-sm-12" height="500" src="<?= $model->linkToVideo ?>">
    </iframe>

    <?php if (!UsersLessons::findOne(['lesson_id' => $model->id])) { ?>
        <?= Html::button('Урок просмотрен',
            ['click-event' => 'reviewed', 'lesson-id' => $model->id, 'class' => 'btn btn-primary']) ?>
    <?php } ?>
</div>

<script>
    $(document)
        .on('click', '[click-event="reviewed"]', function () {
            let lessonId = $(this).attr('lesson-id');
            $.post('/index.php?r=/ajax/lessons/reviewed', {'lessonId': lessonId})
                .done(function (RESULT) {
                    RESULT = JSON.parse(RESULT);
                    if (RESULT.status) {
                        window.location.href = window.location.pathname + `<?= $url ?>`
                    } else {
                        $(document).append(
                            '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
                            '<strong>Ошибка соединения с сервером</strong>' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                            '</div>'
                        );
                    }
                })
                .fail(function () {
                    $(document).append(
                        '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
                        '<strong>Ошибка соединения с сервером</strong>' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                        '<span aria-hidden="true">&times;</span>' +
                        '</button>' +
                        '</div>'
                    );
                })
            ;
            return false;
        });
</script>