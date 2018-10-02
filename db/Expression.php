<?php

namespace pvsaintpe\boost\db;

use yii\db\Expression as BaseExpression;
use yii\base\Event;

class Expression extends BaseExpression
{

    /**
     * @var ActiveQuery
     */
    public $query;

    /**
     * @inheritdoc
     */
    public function __construct($expression, $params = [], $config = [])
    {
        parent::__construct($expression, $params, $config);
        if ($this->query instanceof ActiveQuery) {
            $this->query->on(ActiveQuery::EVENT_ALIAS, function (Event $event) use ($expression) {
                /* @var $query ActiveQuery */
                $query = $event->sender;
                $this->expression = str_replace('{a}', $query->getAlias(), $expression);
            });
            $this->expression = str_replace('{a}', $this->query->getAlias(), $expression);
        }
    }
}
