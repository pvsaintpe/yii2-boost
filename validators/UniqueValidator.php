<?php

namespace pvsaintpe\boost\validators;

use yii\validators\UniqueValidator as BaseUniqueValidator;

class UniqueValidator extends BaseUniqueValidator
{

    /**
     * @inheritdoc
     */
    public function validateAttribute($model, $attribute)
    {
        if (is_array($this->targetAttribute) && (count($this->targetAttribute) > 1)) {
            $skip = false;
            $keyAttribute = $attribute;
            foreach ($this->targetAttribute as $key => $value) {
                $keyAttribute = is_int($key) ? $value : $key;
                $skip = $this->skipOnError && $model->hasErrors($keyAttribute) || $this->skipOnEmpty && $this->isEmpty($model->$keyAttribute);
                if ($skip) {
                    break;
                }
            }
            if (!$skip && ($keyAttribute == $attribute)) {
                parent::validateAttribute($model, $attribute);
            }
        } else {
            parent::validateAttribute($model, $attribute);
        }
    }

    /**
     * @inheritdoc
     */
    public function addError($model, $attribute, $message, $params = [])
    {
        if (is_array($this->targetAttribute) && (count($this->targetAttribute) > 1)) {
            foreach ($this->targetAttribute as $key => $value) {
                $keyAttribute = is_int($key) ? $value : $key;
                parent::addError($model, $keyAttribute, $message, $params);
            }
        } else {
            parent::addError($model, $attribute, $message, $params);
        }
    }
}
