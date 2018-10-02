<?php

namespace pvsaintpe\boost\base;

use Exception;
use FirePHP;
use yii\log\Logger;
use yii\helpers\VarDumper;
use Yii;

/**
 * @mixin \yii\base\Model
 */
trait ModelDebugTrait
{

    /**
     * @return array
     */
    public function debugData()
    {
        if ($this->hasErrors()) {
            return [
                'class' => get_class($this),
                'attributes' => $this->getAttributes(),
                'errors' => $this->getErrors()
            ];
        } else {
            return [
                'class' => get_class($this),
                'attributes' => $this->getAttributes()
            ];
        }
    }

    /**
     * @param string $message
     * @param string $category
     */
    public function debugLog($message = 'Dump:', $category = 'application')
    {
        $level = $this->hasErrors() ? Logger::LEVEL_ERROR : Logger::LEVEL_INFO;
        Yii::getLogger()->log($message . PHP_EOL . $this->debugDumpAsString(), $level, $category);
    }

    /**
     * @param string $label
     */
    public function debugFirebug($label = null)
    {
        $instance = FirePHP::getInstance(true);
        $instance::fb($this->debugData(), $label, $this->hasErrors() ? FirePHP::ERROR : FirePHP::INFO);
    }

    public function debugDump()
    {
        VarDumper::dump($this->debugData());
    }

    /**
     * @return string
     */
    public function debugDumpAsString()
    {
        return VarDumper::dumpAsString($this->debugData());
    }

    /**
     * @param string $message
     * @param int $code
     * @param Exception $previous
     * @return InvalidModelException
     */
    public function newException($message = null, $code = 0, Exception $previous = null)
    {
        /* @var $this \yii\base\Model */
        return new InvalidModelException($this, $message, $code, $previous);
    }
}
