<?php

namespace pvsaintpe\boost\test;

use yii\test\ActiveFixture as BaseActiveFixture;

/**
 * Class ActiveFixture
 * @package pvsaintpe\boost\test
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