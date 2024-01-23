<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Cookie;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\Usuario;
use app\core\Application;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->setLayout('loginRegisterForm');

        $userModel = new Usuario();



        if ($request->isPost()) {
            $userModel->loadData($request->getBody());
            if ($userModel->validate() && $userModel->save()) {
                Application::$app->session->setFlash('success', 'Usuario registrado!');
                Application::$app->response->redirect('/');
            }

        }


        return $this->render(
            'register',
            [
                'model' => $userModel,

            ]
        );
    }

    public function login(Request $request, Response $response)
    {
        $this->setLayout('loginRegisterForm');
        $body = $request->getBody();
        $formModel = new LoginForm();
        $cookie = new Cookie();

        if ($request->isPost()) {
            $formModel->loadData($request->getBody());

            if ($formModel->validate() && $formModel->login()) {
                if (isset($body['recordar'])) {
                    $cookie->create('test', $body['prueba'], time() + (86400 * 30));
                } else {
                    $cookie->delete('test');
                }
                $response->redirect('/');
            }
        }

        return $this->render(
            'login',
            [
                'model' => $formModel,
                'cookie' => $cookie,
                'body' => $body,
            ]
        );
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }
}