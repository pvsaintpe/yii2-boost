<?php

namespace pvsaintpe\boost\tests;

use yii\web\Request as WebRequest;

class Request extends WebRequest
{

    /**
     * @var bool
     */
    private $fakeIsAjax = false;

    /**
     * @param bool $fakeIsAjax
     * @return $this
     */
    public function setFakeIsAjax($fakeIsAjax)
    {
        $this->fakeIsAjax = $fakeIsAjax;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getIsAjax()
    {
        return $this->fakeIsAjax;
    }
}
