<?php

namespace app\core;

use http\Header;

class Response
{

    public function setStatusCode(int $code): void
    {
        http_response_code($code);
    }

    public function redirect(string $route): void
    {
        header('location: ' . $route);
    }
}