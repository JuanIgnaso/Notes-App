<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\Usuario;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->setLayout('loginRegisterForm');

        $userModel = new Usuario();

        return $this->render(
            'register',
            ['model' => $userModel]
        );
    }

    public function login(Request $request)
    {
        $this->setLayout('loginRegisterForm');

        $userModel = new Usuario();

        return $this->render(
            'login',
            ['model' => $userModel]
        );
    }
}