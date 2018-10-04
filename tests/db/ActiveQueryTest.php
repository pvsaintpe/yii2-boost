<?php

namespace pvsaintpe\boost\tests\db;

use pvsaintpe\boost\db\ActiveQuery;
use yii\phpunit\TestCase;
use Yii;

class ActiveQueryTest extends TestCase
{

    public function testPropertyAlias()
    {
        $mock = $this->createPartialMock(ActiveQuery::className(), ['getAlias']);
        $mock->method('getAlias')->willReturn('foo');
        /* @var $mock ActiveQuery */
        static::assertEquals('foo', $mock->alias);
    }

    public function testMethodGetA()
    {
        $mock = $this->createPartialMock(ActiveQuery::className(), ['getAlias']);
        $mock->method('getAlias')->willReturn('foo');
        /* @var $mock ActiveQuery */
        static::assertEquals('foo', $mock->getA());
    }

    public function testPropertyA()
    {
        $mock = $this->createPartialMock(ActiveQuery::className(), ['getAlias']);
        $mock->method('getAlias')->willReturn('foo');
        /* @var $mock ActiveQuery */
        static::assertEquals('foo', $mock->a);
    }

    public function testMethodA()
    {
        $mock = $this->createPartialMock(ActiveQuery::className(), ['getAlias']);
        $mock->method('getAlias')->willReturn('foo');
        /* @var $mock ActiveQuery */
        static::assertEquals('foo', $mock->a());
        static::assertEquals('foo.column', $mock->a('column'));
        static::assertEquals([], $mock->a([]));
        static::assertEquals(['foo.column'], $mock->a(['column']));
        static::assertEquals([
            'foo.column1',
            'foo.column2'
        ], $mock->a([
            'column1',
            'column2'
        ]));
        static::assertEquals([
            'foo.column1' => 1,
            'foo.column2' => 2
        ], $mock->a([
            'column1' => 1,
            'column2' => 2
        ]));
    }
}
