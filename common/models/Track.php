<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "track".
 *
 * @property int $id
 * @property string $name
 * @property int $created_at
 * @property int $updated_At
 */
class Track extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'track';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_At'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'created_at' => 'Created At',
            'updated_At' => 'Updated  At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return TrackQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TrackQuery(get_called_class());
    }
}