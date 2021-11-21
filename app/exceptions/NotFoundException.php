<?php
namespace cursophp7dc\app\exceptions;

class NotFoundException extends AppException
{
    public function __construct(string $message, $code = 404)
    {
        parent::__construct($message, $code);
    }
}