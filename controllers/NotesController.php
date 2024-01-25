<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\middlewares\LoggedMiddleware;
use app\core\Request;
use app\models\Notas;

class NotesController extends Controller
{
    public function __construct()
    {
        #restringir a usuarios no loggeados a la zona de notas.
        $this->registerMiddleware(new AuthMiddleware(['userNotes']));

    }

    public function userNotes(Request $request)
    {
        $model = new Notas();

        return $this->render('misNotas', [
            'model' => $model,
        ]);
    }

    public function createNote(Request $request)
    {
        $model = new Notas();
        if ($request->isPost()) {
            $model->loadData($request->getBody());
            if ($model->save()) {
                Application::$app->session->setFlash('success', 'Nueva nota ha sido creada');
                Application::$app->response->redirect('/misNotas');
            }
        }
    }

    public function inicio(Request $request)
    {
        return $this->render('home');
    }
}