<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\middlewares\LoggedMiddleware;
use app\core\Request;
use app\models\Estado;
use app\models\Notas;

class NotesController extends Controller
{
    public function __construct()
    {
        #restringir a usuarios no loggeados a la zona de notas.
        $this->registerMiddleware(new AuthMiddleware(['userNotes', 'editarNota']));

    }

    public function userNotes(Request $request)
    {
        $model = new Notas();
        $estados = new Estado();
        $misNotas = $model->getUserNotes();

        ###El usuario está buscando algo
        if ($request->isPost()) {
            $body = $request->getBody();
            if (isset($body['importante'])) {
                $model->importante = $body['importante'];
            }
            $model->loadData(['titulo' => $body['tituloNota'], 'estados' => $body['estados']]);
            $misNotas = $model->getByTitle();

        }

        return $this->render('misNotas', [
            'model' => $model,
            'notas' => $misNotas,
            'estados' => $estados->getAll(),
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
                ###Mostrar errores en alerta
                $errors = array_map(fn($err) => $err[0], $model->errors);

                Application::$app->session->setFlash('errorInsertar', 'Error: ' . implode(', ', $errors));
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

    public function marcarImportante(Request $request)
    {
        $model = new Notas();
        if ($request->isPost()) {
            $model->loadData($request->getBody());
            if ($model->markImportant()) {
                Application::$app->response->setStatusCode(200);
                exit;
            } else {
                Application::$app->response->setStatusCode(400);
                echo json_encode(['error' => 'No se ha podido realizar la operación']);
                exit;
            }
        }
    }

    public function buscarNota(Request $request)
    {
        $model = new Notas();
        if ($request->isPost()) {
            $model->loadData($request->getBody());
            $lista = $model->getNoteTitleList();
            if (!$lista || strlen(trim($model->titulo)) == 0) {
                Application::$app->response->setStatusCode(400);
                echo json_encode(['error' => 'No se encuentran registros...']);
                exit;
            } else {
                Application::$app->response->setStatusCode(200);
                echo json_encode($lista);
                exit;
            }
        }

    }

    public function editarNota(Request $request)
    {

        $this->setLayout('editNote');
        $model = new Notas();
        $estados = new Estado();
        if ($request->isGet()) {
            $model->loadData($request->getBody());
            $model->loadData($model->getNote());

            if (!$model) {
                Application::$app->session->setFlash('error', 'La nota que intentas editar no existe');
                Application::$app->response->redirect('/misNotas');
            }
        }
        if ($request->isPost()) {
            $model->loadData($request->getBody());
            if ($model->validate() && $model->update()) {
                Application::$app->session->setFlash('success', "Se han aplicado los cambios con éxito!");
                Application::$app->response->redirect('/misNotas');
            }
        }
        return $this->render('EditarNota', [
            'estados' => $estados->getAll(),
            'model' => $model,
        ]);
    }

    public function inicio(Request $request)
    {

        return $this->render('home');
    }
}