<?php

namespace common\queries;

/**
 * Class ActiveQuery
 *
 * @property string $alias
 *
 * @package recatch\db
 */
class ActiveQuery extends \yii\db\ActiveQuery
{
    //region Private Properties
    private $tableAlias = null;
    //endregion Private Properties

    //region Initialization
    public function init()
    {
        /** @var ActiveRecord $modal */
        $modal            = $this->modelClass;
        $this->tableAlias = $modal::tableName();

        parent::init();
    }
    //endregion Initialization

    //region Getters/Setters
    public function getAlias()
    {
        return $this->tableAlias;
    }
    //endregion Getters/Setters

    //region Public Methods
    public function from($tables)
    {
        if (!is_array($tables)) {
            $tables = preg_split('/\s*,\s*/', trim($tables), -1, PREG_SPLIT_NO_EMPTY);
        }

        $tmp = [];
        foreach ($tables as $k => $table) {
            if (is_string($k)) {
                $tmp[$k] = $table;
            } elseif (preg_match('/^([\w\-]+) ([\w\-{}\[\]]+)$/', $table, $result)) {
                $tmp[$result[1]] = $result[0];
            } else {
                $tmp[$table] = $table;
            }
        }

        $tables = $tmp;

        if (count($tables) > 1) {
            //TODO
        } else {
            $this->tableAlias = array_keys($tables)[0];
        }

        return parent::from($tables);
    }
    //endregion Public Methods
}
