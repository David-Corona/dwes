<?php
try {
    require 'core/bootstrap.php';

    require Router::load('app/routes.php')->direct(Request::uri(), Request::method());
}
catch(notFoundException $notFoundException)
{
    die($notFoundException->getMessage());
}

