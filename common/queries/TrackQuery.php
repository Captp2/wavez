<?php

namespace common\queries;

use common\models\Playlist;

/**
 * This is the ActiveQuery class for [[Track]].
 *
 * @see Track
 */
class TrackQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Track[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Track|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTracks(): \yii\db\ActiveQuery
    {
        return $this->hasMany(Playlist::class, ['id' => 'playlist_id'])
            ->viaTable('playlist_track', ['track_id' => 'id']);
    }
}