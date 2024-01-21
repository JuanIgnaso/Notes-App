<?php
require_once __DIR__ . '/../vendor/autoload.php';

//Cargar variables de entorno
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

use app\core\Application;

//Configuraciones
$config = [
    // 'userClass' => Usuario::class,
    // //Configuración de la base de datos
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ],
];

$app = new Application(dirname(__DIR__), $config);

###AQUÍ SE DEFINEN LAS RUTAS###
$app->router->get('/', [app\controllers\SiteController::class, 'homePage']);
$app->router->get('/misNotas', [app\controllers\NotesController::class, 'userNotes']);

$app->run();