<?php

use yii\db\Migration;

/**
 * Class m230226_143648_lessons
 */
class m230226_143648_lessons extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('lessons', [
            'id' => $this->primaryKey(),
            'title' => $this->string(50)->notNull()->comment('Заголовок урока'),
            'description' => $this->text()->comment('Описания урока'),
            'linkToVideo' => $this->string(150)->notNull()->comment('Ссылка к видео'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lessons');
    }
}
