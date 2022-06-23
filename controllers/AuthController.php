<?php

namespace app\controllers;

use Safarmurod\PhpMvcCore\Application;
use Safarmurod\PhpMvcCore\Controller;
use Safarmurod\PhpMvcCore\middlewares\AuthMiddleware;
use Safarmurod\PhpMvcCore\Request;
use Safarmurod\PhpMvcCore\Response;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

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