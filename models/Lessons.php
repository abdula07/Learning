<?php

namespace app\models;

class Lessons extends \app\models\gii\Lessons
{
    public function attributeLabels()
    {
        return [
            'title'       => 'Заголовок',
            'description' => 'Описания',
            'linkToVideo' => 'Ссылка к видео'
        ];
    }
}