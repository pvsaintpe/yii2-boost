<?php

namespace pvsaintpe\boost\log;

use Psr\Log\AbstractLogger;
use yii\log\Logger;
use Psr\Log\LogLevel;
use yii\helpers\VarDumper;
use Yii;

class PsrLogger extends AbstractLogger
{

    /**
     * @var int[]
     */
    public $levelMap = [
        LogLevel::EMERGENCY => Logger::LEVEL_ERROR,
        LogLevel::ALERT => Logger::LEVEL_ERROR,
        LogLevel::CRITICAL => Logger::LEVEL_ERROR,
        LogLevel::ERROR => Logger::LEVEL_ERROR,
        LogLevel::WARNING => Logger::LEVEL_WARNING,
        LogLevel::NOTICE => Logger::LEVEL_WARNING,
        LogLevel::INFO => Logger::LEVEL_INFO,
        LogLevel::DEBUG => Logger::LEVEL_PROFILE
    ];

    /**
     * @var string
     */
    public $category = 'application';

    /**
     * @inheritdoc
     */
    public function log($level, $message, array $context = [])
    {
        if (count($context)) {
            $message .= PHP_EOL . VarDumper::dumpAsString($context);
        }
        Yii::getLogger()->log($message, $this->levelMap[$level], $this->category);
    }
}
