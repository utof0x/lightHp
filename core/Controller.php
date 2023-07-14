<?php

namespace app\core;

use app\core\middlewares\BaseMiddleware;

class Controller
{
    public string $layout = 'main';
    public string $action = '';
    /** @var BaseMiddleware[] $middlewares */
    protected array $middlewares = [];

    /**
     * @return array
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
    }

    protected function render($view, $params = []): string
    {
        return Application::$app->view->renderView($view, $params);
    }

    protected function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }
}