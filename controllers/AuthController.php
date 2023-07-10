<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;

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
        $registerModel = new RegisterModel();

        if ($request->isPost()) {
            $registerModel->loadData($request->getBody());

            if ($registerModel->validate()) {
                return $this->render('register', ['model' => $registerModel]);
            }


            return $this->render('register', ['model' => $registerModel]);
        }
        return $this->render('register');
    }
}