<?php

namespace cursophp7dc\core;

class Response
{
    //genera el mainContent a partir de la vista que le pasamos
    public static function renderView(string $name, string $layout = 'layout', array $data = [])
    {
        extract($data);

        ob_start();

        require __DIR__ . "/../app/views/$name.view.php";

        $mainContent = ob_get_clean();

        require __DIR__ . "/../app/views/$layout.view.php";
    }
}