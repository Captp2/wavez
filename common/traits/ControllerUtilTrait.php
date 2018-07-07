<?php

namespace common\traits;

use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

trait ControllerUtilTrait
{
    /**
     * @param int $id
     * @return null|ActiveRecord
     * @throws NotFoundHttpException
     */
    public function findModel(int $id)
    {
        if ($model = $this->modelClass::findOne($id)) {
            return $model;
        }

        throw new NotFoundHttpException(\Yii::t('user/frontend', 'Could not find user #{ID}', ['ID' => $id]));
    }
}