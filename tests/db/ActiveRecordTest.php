<?php

namespace pvsaintpe\boost\tests\db;

use yii\db\Expression;
use pvsaintpe\boost\tests\TestActiveRecord;
use yii\phpunit\TestCase;

class ActiveRecordTest extends TestCase
{

    public function testRequiredField()
    {
        $model = new TestActiveRecord;
        static::assertTrue($model->isAttributeRequired('requiredField'));
    }

    public function testDateField()
    {
        $model = new TestActiveRecord;
        $model->dateField = new Expression('NOW()');
        static::assertTrue($model->validate(['dateField']));
    }
}
