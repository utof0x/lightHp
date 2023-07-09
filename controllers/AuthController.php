<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class AuthController extends Controller
{
    public function login(Request $request): string
    {
        $this->setLayout('auth');

        if ($request->isPost()) {
            return 'Handle login data';
        }
        return $this->render('login');
    }

    public function register(Request $request): string
    {
        $this->setLayout('auth');

        if ($request->isPost()) {
            return 'Handle register data';
        }
        return $this->render('register');
    }
}