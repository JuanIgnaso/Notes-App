<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Cookie;
use app\core\middlewares\AuthMiddleware;
use app\core\middlewares\LoggedMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\Usuario;
use app\core\Application;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->loggedMiddleware(new LoggedMiddleware(['login', 'register']));
    }
    public function register(Request $request)
    {
        $this->setLayout('loginRegisterForm');

        $userModel = new Usuario();

        if ($request->isPost()) {
            $userModel->loadData($request->getBody());
            if ($userModel->validate() && $userModel->save()) {
                /*
                -Loguear cuenta registrada-
                Si llegamos aquí, quiere decir que el registro ya existe en la tabla.
                */
                $body = $request->getBody();
                $formModel = new LoginForm();
                $formModel->loadData(['email' => $body['email'], 'password' => $body['password']]);
                $formModel->login();

                Application::$app->session->setFlash('success', "Usuario registrado, bienvenido/a " . $body['nombre'] . "!");
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
                    $cookie->create('email', $body['email'], time() + (86400 * 30));
                } else {
                    $cookie->delete('email');
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