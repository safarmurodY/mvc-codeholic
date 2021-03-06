<?php

namespace app\models;

use Safarmurod\PhpMvcCore\Application;
use Safarmurod\PhpMvcCore\Model;

class LoginForm extends Model
{

    public string $email = '';
    public string $password = '';


    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }

    public function login()
    {
        $user = User::findOne(['email' => $this->email]);
        if (!$user){
            $this->addError('email', 'No user Found For this Email');
            return false;
        }
        if (!password_verify($this->password, $user->password)){
            $this->addError('password', 'Password is incorrect');
            return false;
        }


        return Application::$app->login($user);
    }

    public function labels(): array
    {
        return [
            'email' => 'Email',
            'password' => 'Password',
        ];
    }
}