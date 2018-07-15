<?php

use yii\db\Migration;

/**
 * Class m180708_002406_createTracksTable
 */
class m180708_002406_createTracksTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('track', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'created_at' => $this->integer(),
            'updated_At' => $this->integer(),
        ]);

        $this->createTable('playlist_track', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'playlist_id' => $this->integer(),
        ]);

        $this->addForeignKey('FK-playlist_track-user_id', 'playlist_track', 'user_id', 'user', 'id');
        $this->addForeignKey('FK-playlist_track-playlist_id', 'playlist_track', 'playlist_id', 'playlist', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK-playlist_track-user_id', 'playlist_track');
        $this->dropForeignKey('FK-playlist_track-playlist_id', 'playlist_track');

        $this->dropTable('playlist_track');
        $this->dropTable('track');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180708_002406_createTracksTable cannot be reverted.\n";

        return false;
    }
    */
}
