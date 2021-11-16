<?php

use cursophp7dc\app\exceptions\AppException;
use cursophp7dc\app\exceptions\NotFoundException;
use cursophp7dc\core\App;
use cursophp7dc\core\Request;

try {
    require __DIR__ . '/../core/bootstrap.php';

    App::get('router')->direct(Request::uri(), Request::method());
}
catch(notFoundException $notFoundException)
{
    die($notFoundException->getMessage());
}
catch (AppException $appException)
{
    die($appException->getMessage());
}
