<?php

namespace app\controllers;

use app\core\Request;

class AuthController extends \app\core\Controller
{
    public function login()
    {
        return $this->render('login');
    }
    public function register(Request $request)
    {
        if ($request->isPost()){
            return 'Handle';
        }
        return $this->render('register');
    }
}