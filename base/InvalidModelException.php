<?php

namespace pvsaintpe\boost\base;

use Exception;
use yii\base\InvalidValueException;
use yii\base\Model;
use yii\helpers\VarDumper;

class InvalidModelException extends InvalidValueException
{

    /**
     * @var Model
     */
    private $model;

    /**
     * @param Model $model
     * @param string $message
     * @param int $code
     * @param Exception $previous
     */
    public function __construct(Model $model, $message = null, $code = 0, Exception $previous = null)
    {
        $this->model = $model;
        if (is_null($message) && $model->hasErrors()) {
            $message = implode(' ', array_map(function ($errors) {
                return implode(' ', $errors);
            }, $model->getErrors()));
        }
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Invalid Model';
    }

    /**
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return array
     */
    public function getModelDebugData()
    {
        $model = $this->getModel();
        if ($model instanceof ModelDebugTrait) {
            return $model->debugData();
        } elseif ($model->hasErrors()) {
            return [
                'class' => get_class($model),
                'attributes' => $model->getAttributes(),
                'errors' => $model->getErrors()
            ];
        } else {
            return [
                'class' => get_class($model),
                'attributes' => $model->getAttributes()
            ];
        }
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return parent::__toString() . PHP_EOL . VarDumper::dumpAsString($this->getModelDebugData());
    }
}
