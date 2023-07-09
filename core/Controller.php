<?php

namespace app\core;

class Controller
{
    protected function render($view, $params = []): string
    {
        return Application::$app->router->renderView($view, $params);
    }
}