<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;

class SiteController extends Controller
{

    public function home()
    {

        return $this->render('home');
    }

    public function contact()
    {
        return $this->render('contact');
    }
    public function handleContact()
    {
        $body = Application::$app->request->getBody();
        echo "<pre>";
        var_dump($body);
        echo "</pre>";
        die;
        return 'Handling';
    }
}