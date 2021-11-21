<?php

use cursophp7dc\app\exceptions\AppException;
use cursophp7dc\core\App;
use cursophp7dc\core\Request;

try {
    require __DIR__ . '/../core/bootstrap.php';

    App::get('router')->direct(Request::uri(), Request::method());
}
catch (AppException $appException)
{
    $appException->handleError();
}
