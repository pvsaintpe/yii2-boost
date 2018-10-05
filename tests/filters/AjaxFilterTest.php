<?php

namespace pvsaintpe\boost\tests\filters;

use yii\phpunit\TestCase;
use Yii;

class AjaxFilterTest extends TestCase
{

    public function testAjaxRequest()
    {
        /* @var $request \pvsaintpe\boost\tests\Request */
        $request = Yii::$app->getRequest();
        $request->setFakeIsAjax(true);
        static::assertEquals('ok', Yii::$app->runAction('test/get-ok'));
    }

    public function testNonAjaxRequest()
    {
        static::expectException('yii\web\BadRequestHttpException');
        static::assertEquals('ok', Yii::$app->runAction('test/get-ok'));
    }
}
