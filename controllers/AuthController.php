<?php

namespace app\controllers;

use juanignaso\phpmvc\framework\Controller;
use juanignaso\phpmvc\framework\middlewares\LoggedMiddleware;
use juanignaso\phpmvc\framework\Request;
use juanignaso\phpmvc\framework\Response;
use app\models\LoginForm;
use juanignaso\phpmvc\framework\Token;
use juanignaso\phpmvc\framework\Usuario;
use juanignaso\phpmvc\framework\Application;

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

        if ($request->isPost()) {
            $formModel->loadData($request->getBody());

            if ($formModel->validate() && $formModel->login()) {

                //Crear token para usuario si este marca la casilla de 'remember_me'
                //try {
                if (isset($body['remember_me'])) {
                    $this->remember_me(Application::$app->user->id);
                }
                //} catch (\Exception $e) {
                // echo 'Message: ' . $e->getMessage();
                //}
                //
                $response->redirect('/');
            }
        }

        return $this->render(
            'login',
            [
                'model' => $formModel,
                'body' => $body,
            ]
        );
    }


    function remember_me($user_id, int $day = 30)
    {
        $tokenModel = new Token();

        [$selector, $validator, $token] = $tokenModel->generate_tokens();

        // remove all existing token associated with the user id
        $tokenModel->borrarTokensUsuario($user_id);

        // set expiration date
        $expired_seconds = time() + 60 * 60 * 24 * $day;

        // insert a token to the database
        $hash_validator = password_hash($validator, PASSWORD_DEFAULT);
        $expiry = date('Y-m-d H:i:s', $expired_seconds);

        if ($tokenModel->insertarTokenUsuario($user_id, $selector, $hash_validator, $expiry)) {
            setcookie('remember_me', $token, $expired_seconds);
        }
    }


    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }
}