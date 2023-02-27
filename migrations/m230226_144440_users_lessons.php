<?php

use yii\db\Migration;

/**
 * Class m230226_144440_users_lessons
 */
class m230226_144440_users_lessons extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users_lessons', [
            'id'        => $this->primaryKey(),
            'user_id'   => $this->integer()->notNull()->comment('ID пользователя'),
            'lesson_id' => $this->integer()->notNull()->comment('ID урока'),
        ]);
        $this->addForeignKey(
            'FK_UsersLessons_Users',
            'users_lessons',
            'user_id',
            'users',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'FK_UsersLessons_Lessons',
            'users_lessons',
            'lesson_id',
            'lessons',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_UsersLessons_Lessons', 'users_lessons');
        $this->dropForeignKey('FK_UsersLessons_Users', 'users_lessons');
        $this->dropTable('users_lessons');
    }
}
