<?php
namespace cursophp7dc\app\exceptions;

use Exception;

class FileException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}