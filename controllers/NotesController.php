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
        $misNotas = $model->getUserNotes();

        return $this->render('misNotas', [
            'model' => $model,
            'notas' => $misNotas,
        ]);
    }

    public function crearNota(Request $request)
    {
        $model = new Notas();
        if ($request->isPost()) {
            $model->loadData($request->getBody());
            if ($model->validate() && $model->save()) {
                Application::$app->session->setFlash('success', 'Nueva nota ha sido creada');
            } else {
                Application::$app->session->setFlash('error', 'Error: ' . implode(', ', $model->errors));
            }
            Application::$app->response->redirect('/misNotas');
        }
    }

    public function borrarNota(Request $request)
    {
        $model = new Notas();
        if ($request->isPost()) {
            $model->loadData($request->getBody());
            if ($model->delete()) {
                Application::$app->response->setStatusCode(200);
                exit;
            } else {
                Application::$app->response->setStatusCode(400);
                Application::$app->session->setFlash('error', 'Error: ' . 'La nota que intentas borrar no existe!');
                exit;
            }
        }
    }

    public function buscarNota(Request $request)
    {
        $model = new Notas();
        if ($request->isPost()) {
            $model->loadData($request->getBody());
            $lista = $model->getAttrList('titulo');
            if (!$lista) {
                Application::$app->response->setStatusCode(400);
                exit;
            } else {
                Application::$app->response->setStatusCode(200);
                echo json_encode($lista);
                exit;
            }
        }

    }

    public function inicio(Request $request)
    {
        return $this->render('home');
    }
}