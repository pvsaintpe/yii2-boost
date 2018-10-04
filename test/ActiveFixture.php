<?php

namespace yii\boost\test;

use yii\test\ActiveFixture as BaseActiveFixture;

/**
 * Class ActiveFixture
 * @package yii\boost\test
 */
class ActiveFixture extends BaseActiveFixture
{
    /**
     * @var array
     */
    public $backDepends = [];
    /**
     * @inheritdoc
     */
    public function unload()
    {
        parent::unload();
        $this->resetTable();
    }
}