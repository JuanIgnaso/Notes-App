<?php

namespace app\controllers;

use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\middlewares\LoggedMiddleware;
use app\core\Request;

class NotesController extends Controller
{
    public function __construct()
    {
        #restringir a usuarios no loggeados a la zona de notas.
        $this->registerMiddleware(new AuthMiddleware(['userNotes']));

    }

    public function userNotes(Request $request)
    {
        return $this->render('misNotas');
    }

    public function inicio(Request $request)
    {
        return $this->render('home');
    }
}