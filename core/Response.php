<?php

namespace cursophp7dc\core;

use cursophp7dc\app\exceptions\AppException;

class Response
{
    //genera el mainContent a partir de la vista que le pasamos
    /**
     * @param string $name
     * @param string $layout
     * @param array $data
     * @throws AppException
     */
    public static function renderView(string $name, string $layout = 'layout', array $data = [])
    {
        extract($data);

        $app['user'] = App::get('appUser');

        ob_start();

        require __DIR__ . "/../app/views/$name.view.php";

        $mainContent = ob_get_clean();

        require __DIR__ . "/../app/views/$layout.view.php";
    }
}