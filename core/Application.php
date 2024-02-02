<?php
namespace app\core;

use app\core\db\DataBase;
use app\core\db\DBmodel;
use app\models\TokensUsuario;
use app\models\Usuario;

/**
 * Class Application
 * 
 * @package app\core
 */
class Application
{

    public static string $ROOT_DIR; //para evitar que se sobreescriba

    public string $layout = 'main';

    public string $userClass;

    public Router $router;

    public Request $request;

    public Response $response;

    public Session $session;

    public DataBase $db;

    public static Application $app;

    public ?Controller $controller = null;
    public ?Usuario $user;

    public View $view;

    public Cookie $cookie;

    public TokensUsuario $Token;


    public function __construct($rootPath, array $config)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->userClass = $config['userClass'];
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();
        $this->cookie = new Cookie();
        $this->db = new DataBase($config['db']);
        $this->Token = new TokensUsuario();

        //Fetch user between page navigation, to access it in any point of the aplication
        $primaryValue = $this->session->get('user');
        if ($primaryValue) {
            /*No deja llamar métodos no estáticos de forma estática*/
            $c = new $this->userClass;
            $primaryKey = $c->primaryKey();
            $this->user = $c->findOne([$primaryKey => $primaryValue]);
        } else {
            $this->user = NULL;
        }


    }

    /**
     * Inicia la aplicación haciendo uso del router.
     */
    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('error_page', [
                'exception' => $e,
            ]);

        }
    }

    // public function getController(): Controller
    // {
    //     return $this->controller;
    // }


    // public function setController(Controller $controller): void
    // {
    //     $this->controller = $controller;
    // }

    public function login(Usuario $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    // /**
    //  * Borrar la sesión actual dentro de aplicación
    //  */
    public function logout()
    {
        if (!self::isGuest()) {
            $this->Token->borrarTokensUsuario($this->user->id);
            $this->cookie->delete('remember_me');
        }
        $this->user = NULL;
        $this->session->remove('user');

    }

    public function isUserLoggedIn(): bool
    {
        //Comprobar que el usuario tiene sesion iniciada
        if (self::$app->user != null) {
            return true;
        }

        //Comprobar el token de remember me
        $token = filter_input(INPUT_COOKIE, 'remember_me', FILTER_SANITIZE_STRING);

        if ($token && self::$app->Token->isTokenValido($token)) {
            $usuario = self::$app->Token->encontrarUsrPorToken($token);
            if ($usuario) {

            }
        }
    }

    // /**
    //  * Determinar si el usuario está o no logueado en la web
    //  */
    public static function isGuest()
    {
        return self::$app->user == null;
    }

}


?>