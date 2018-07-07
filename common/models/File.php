<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "file".
 *
 * @property int $id
 * @property string $file_name
 * @property int $created_at
 * @property int $updated_at
 * @property string $public_name
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'integer'],
            [['file_name', 'public_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file_name' => 'File Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'public_name' => 'Public Name',
        ];
    }
}