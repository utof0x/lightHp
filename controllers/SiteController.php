<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;

class SiteController extends Controller
{
    public function home(): string
    {
        $params = [
            'name' => 'Test name',
        ];
        return $this->render('home', $params);
    }

    public function contact(): string
    {
        return $this->render('contact');
    }

    public function handleContact(): string
    {
        return 'Handling submitted data';
    }
}