<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    public function login(Request $request, Response $response): string
    {
        $loginFrom = new LoginForm();
        $this->setLayout('auth');

        if ($request->isPost()) {
            $loginFrom->loadData($request->getBody());

            if ($loginFrom->validate() && $loginFrom->login()) {
                $response->redirect('/');
                return '';
            }
        }

        return $this->render('login', ['model' => $loginFrom]);
    }

    public function register(Request $request): string
    {
        $this->setLayout('auth');
        $user = new User();

        if ($request->isPost()) {
            $user->loadData($request->getBody());

            if ($user->validate() && $user->save()) {
                Application::$app->session->setFlash('success', 'Thanks for registration!');
                Application::$app->response->redirect('/');
            }

            return $this->render('register', ['model' => $user]);
        }

        return $this->render('register', ['model' => $user]);
    }

    public function logout(Request $request, Response $response): void
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    public function profile(): string
    {
        return $this->render('profile');
    }
}