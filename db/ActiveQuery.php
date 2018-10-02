<?php

namespace pvsaintpe\boost\db;

use yii\db\ActiveQuery as BaseActiveQuery;
use yii\db\Expression;
use yii\base\NotSupportedException;

/**
 * @property string $alias
 * @property string $a
 */
class ActiveQuery extends BaseActiveQuery
{

    /**
     * @event Event
     */
    const EVENT_ALIAS = 'alias';

    /**
     * @var string
     */
    private $alias;

    /**
     * @inheritdoc
     */
    public function from($tables)
    {
        $this->alias = null;
        $result = parent::from($tables);
        $this->trigger(static::EVENT_ALIAS);
        return $result;
    }

    /**
     * @inheritdoc
     */
    public function alias($alias)
    {
        $this->alias = null;
        $result = parent::alias($alias);
        $this->trigger(static::EVENT_ALIAS);
        return $result;
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        if (!is_null($this->alias)) {
            return $this->alias;
        }
        if (empty($this->from)) {
            /* @var $modelClass ActiveRecord */
            $modelClass = $this->modelClass;
            $tableName = $modelClass::tableName();
        } else {
            $tableName = '';
            foreach ($this->from as $alias => $tableName) {
                if (is_string($alias)) {
                    $this->alias = $alias;
                    return $alias;
                } else {
                    break;
                }
            }
        }
        if (preg_match('/^(.*?)\s+({{\w+}}|\w+)$/', $tableName, $matches)) {
            $alias = $matches[2];
        } else {
            $alias = $tableName;
        }
        $this->alias = $alias;
        return $alias;
    }

    /**
     * @return string
     */
    public function getA()
    {
        return $this->getAlias();
    }

    /**
     * @param string|array $column
     * @return string|array
     */
    public function a($column = null)
    {
        $alias = $this->getAlias();
        if (is_null($column)) {
            return $alias;
        } elseif (is_array($column)) {
            $columns = [];
            foreach ($column as $key => $value) {
                if (is_int($key)) {
                    $columns[$key] = $alias . '.' . $value;
                } else {
                    $columns[$alias . '.' . $key] = $value;
                }
            }
            return $columns;
        } else {
            return $alias . '.' . $column;
        }
    }

    /**
     * @param array $condition
     * @return $this
     */
    public function andWhereA(array $condition)
    {
        return $this->andWhere($this->a($condition));
    }

    /**
     * @param array $condition
     * @return $this
     */
    public function andFilterWhereA(array $condition)
    {
        return $this->andFilterWhere($this->a($condition));
    }

    /**
     * @return $this
     */
    public function listItems()
    {
        /* @var $modelClass ActiveRecord */
        $modelClass = $this->modelClass;
        $primaryKey = $modelClass::primaryKey();
        if (count($primaryKey) != 1) {
            throw new NotSupportedException('Primary key must be a single column.');
        }
        $this->orderBy($primaryKey[0])->indexBy($primaryKey[0]);
        $titleKey = $modelClass::titleKey();
        if (is_array($titleKey)) {
            $this->orderBy(array_fill_keys($titleKey, SORT_ASC));
            if (count($titleKey) > 1) {
                $separator = $modelClass::getDb()->quoteValue($modelClass::TITLE_SEPARATOR);
                $this->select(new Expression('CONCAT(' . implode(', ' . $separator . ', ', $this->a($titleKey)) . ')'));
            } else {
                $this->select($titleKey);
            }
        } else {
            $this->select($titleKey);
        }
        return $this;
    }
}
