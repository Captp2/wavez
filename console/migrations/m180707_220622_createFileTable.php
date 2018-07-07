<?php

use yii\db\Migration;

/**
 * Class m180707_220622_createFileTable
 */
class m180707_220622_createFileTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('file', [
            'id' => $this->primaryKey(),
            'file_name' => $this->string(255),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'public_name' => $this->string(255)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('file');
    }
}
