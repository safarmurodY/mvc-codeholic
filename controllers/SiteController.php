<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\ContactForm;

class SiteController extends Controller
{

    public function home()
    {

        return $this->render('home');
    }

    public function contact(Request $request, Response $response)
    {
        $contactForm = new ContactForm();
        if ($request->isPost()){
            $contactForm->loadData($request->getBody());
            if ($contactForm->validate() && $contactForm->send()){
                Application::$app->session->setFlash('success', 'WoW');
                return $response->redirect('/contact');
            }
        }
        return $this->render('contact', [
            'model' => $contactForm,
        ]);
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