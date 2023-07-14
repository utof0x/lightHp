<?php

namespace app\models;

use app\core\Application;
use app\core\Model;

class LoginForm extends Model
{
    public string $email = '';
    public string $password = '';

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24]],
        ];
    }

    public function labels(): array
    {
        return [
            'email' => 'Your email',
            'password' => 'Your password',
        ];
    }

    public function login(): bool
    {
        $user = (new User())->findOne(['email' => $this->email]);

        if (!$user) {
            $this->addErrorForRule('email', 'User does not exist with this email address');
            return false;
        }
        if (password_verify($this->password, $user->password)) {
            $this->addErrorForRule('password', 'Password is not correct');
            return false;
        }

        return Application::$app->login($user);
    }
}