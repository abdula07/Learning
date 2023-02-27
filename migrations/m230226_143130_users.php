<?php

use yii\db\Migration;

/**
 * Class m230226_143130_users
 */
class m230226_143130_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id'          => $this->primaryKey(),
            'username'    => $this->string(32)->notNull()->unique()->comment('Логин'),
            'password'    => $this->string(32)->notNull()->comment('Пароль'),
            'isAdmin' => $this->smallInteger(1)->notNull()->defaultValue(0)->comment('Флаг является ли админом'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
    }
}
