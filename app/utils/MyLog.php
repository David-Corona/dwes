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
     * @param string $filename
     * @throws Exception
     */
    private function __construct(string $filename)
    {
        $this->log = new Logger('name');
        $this->log->pushHandler(
            new StreamHandler($filename, Logger::INFO)
        );
    }

    /**
     * @param string $filename
     * @return MyLog
     * @throws Exception
     */
    public static function load(string $filename):MyLog
    {
        return new MyLog($filename);
    }

    /**
     * @param string $message
     */
    public function add(string $message):void
    {
        $this->log->addInfo($message);
    }
}