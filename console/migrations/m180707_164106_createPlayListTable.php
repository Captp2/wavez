<?php

use yii\db\Migration;

/**
 * Class m180707_164106_createPlayListTable
 */
class m180707_164106_createPlayListTable extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('playlist', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'label' => $this->string(128),
        ]);

        $this->addForeignKey('FK-playlist-user', 'playlist', 'user_id', 'user', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('FK-playlist-user', 'playlist');
        $this->dropTable('playlist');
    }
}
