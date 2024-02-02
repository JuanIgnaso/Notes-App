<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Cookie;
use app\core\middlewares\AuthMiddleware;
use app\core\middlewares\LoggedMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\TokensUsuario;
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

                //
                if (isset($body['recordar'])) {
                    $cookie->create('email', $body['email'], time() + (86400 * 30));
                } else {
                    $cookie->delete('email');
                }
                //
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


    function remember_me(int $user_id, int $day = 30)
    {
        $tokenModel = new TokensUsuario();
        $cookie = new Cookie();

        [$selector, $validator, $token] = $tokenModel->generate_tokens();

        // remove all existing token associated with the user id
        $tokenModel->borrarTokensUsuario($user_id);

        // set expiration date
        $expired_seconds = time() + 60 * 60 * 24 * $day;

        // insert a token to the database
        $hash_validator = password_hash($validator, PASSWORD_DEFAULT);
        $expiry = date('Y-m-d H:i:s', $expired_seconds);

        if ($tokenModel->insertarTokenUsuario($user_id, $selector, $hash_validator, $expiry)) {
            $cookie->create('remember_me', $token, $expired_seconds);
        }
    }


    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }
}