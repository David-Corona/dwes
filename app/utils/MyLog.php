<?php
namespace cursophp7dc\app\utils;

use Exception;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class MyLog
{
    /**
     * @var \Monolog\Logger
     */
    private $log;
    /**
     * @var int
     */
    private $level;

    /**
     * @param string $filename
     * @param int $level
     * @throws Exception
     */
    private function __construct(string $filename, int $level)
    {
        $this->level = $level;
        $this->log = new Logger('name');
        $this->log->pushHandler(
            new StreamHandler($filename, $this->level)
        );
    }

    /**
     * @param string $filename
     * @param int $level
     * @return MyLog
     * @throws Exception
     */
    public static function load(string $filename, int $level= Logger::INFO):MyLog
    {
        return new MyLog($filename, $level);
    }

    /**
     * @param string $message
     */
    public function add(string $message):void
    {
        $this->log->log($this->level, $message);
    }
}