<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{
    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
//        $this->setLayout('auth');
        if ($request->isPost()){
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()){
                Application::$app->session->setFlash('success', 'Logged In ! ! !');
                $response->redirect( '/');
                return ;
            }
        }
        return $this->render('login', [
            'model' => $loginForm,
        ]);
    }
    public function register(Request $request)
    {
        $user = new User();
//        $this->setLayout('auth');
        if ($request->isPost()){
            $user->loadData($request->getBody());

            if ($user->validate() && $user->save()){

                Application::$app->session->setFlash('success', 'Registered ! ! !');
                Application::$app->response->redirect( '/');
            }

            return $this->render('register', [
                'model' => $user
            ]);
        }
        return $this->render('register', [
            'model' => $user
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    public function profile()
    {
        return $this->render('profile');
    }
}