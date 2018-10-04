<?php

namespace pvsaintpe\boost\tests;

use pvsaintpe\boost\db\ActiveRecord;
use yii\validators\DateValidator;

class TestActiveRecord extends ActiveRecord
{

    /**
     * @var string
     */
    public $requiredField;

    /**
     * @var string
     */
    public $dateField;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['requiredField', 'dateField'], 'required'],
            [['dateField'], 'date', 'type' => DateValidator::TYPE_DATE]
        ];
    }
}
