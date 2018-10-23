<?php

namespace pvsaintpe\boost\log;

use yii\helpers\Console;
use yii\log\Logger;
use yii\log\Target;

class StdoutTarget extends Target
{

    /**
     * @var int[]
     */
    public $stderrLevels = [Logger::LEVEL_ERROR, Logger::LEVEL_WARNING];

    /**
     * @var array
     */
    public $colorMap = [
        Logger::LEVEL_ERROR => [Console::BOLD, Console::FG_RED],
        Logger::LEVEL_WARNING => [Console::BOLD, Console::FG_YELLOW],
        Logger::LEVEL_INFO => [],
        Logger::LEVEL_TRACE => [Console::FG_CYAN],
        Logger::LEVEL_PROFILE => [Console::FG_PURPLE],
        Logger::LEVEL_PROFILE_BEGIN => [Console::BOLD, Console::FG_PURPLE],
        Logger::LEVEL_PROFILE_END => [Console::FG_PURPLE]
    ];

    /**
     * @inheritdoc
     */
    public $logVars = [];

    /**
     * @inheritdoc
     */
    public $exportInterval = 0;

    /**
     * @var bool
     */
    private $stderrIsNotStdout = false;

    /**
     * @var bool
     */
    private $stderrSupportsColors = false;

    /**
     * @var bool
     */
    private $stdoutSupportsColors = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->stderrIsNotStdout = fstat(\STDERR)['dev'] != fstat(\STDOUT)['dev'];
        $this->stderrSupportsColors = Console::streamSupportsAnsiColors(\STDERR);
        $this->stdoutSupportsColors = Console::streamSupportsAnsiColors(\STDOUT);
    }

    /**
     * @inheritdoc
     */
    public function export()
    {
        foreach ($this->messages as $message) {
            $string = $this->formatMessage($message) . "\n";
            $level = $message[1];
            if (in_array($level, $this->stderrLevels)) {
                if ($this->stderrSupportsColors) {
                    Console::stderr(Console::ansiFormat($string, $this->colorMap[$level]));
                } else {
                    Console::stderr($string);
                }
            }
            if ($this->stdoutSupportsColors) {
                Console::stdout(Console::ansiFormat($string, $this->colorMap[$level]));
            } else {
                Console::stdout($string);
            }
        }
    }
}
