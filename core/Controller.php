<?php

namespace app\core;

class Controller
{
    public string $layout = 'main';

    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
    }

    protected function render($view, $params = []): string
    {
        return Application::$app->router->renderView($view, $params);
    }
}