<?php

use cursophp7dc\app\exceptions\NotFoundException;
use cursophp7dc\core\Request;
use cursophp7dc\core\Router;

try {
    require 'core/bootstrap.php';

    require Router::load('app/routes.php')->direct(Request::uri(), Request::method());
}
catch(notFoundException $notFoundException)
{
    die($notFoundException->getMessage());
}

