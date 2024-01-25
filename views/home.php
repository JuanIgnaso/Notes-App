<?php
use app\core\Application;

$this->title = 'Inicio';
?>

<?php
if (!Application::isGuest()) {
    ?>
    <div id="menuUsuario">
        <ol>
            <li>
                <i class="fa-solid fa-circle-user"></i>
            </li>
            <li>
                <?php echo Application::$app->user->getUserName(); ?>
            </li>
            <li>/</li>
            <li>
                <a href="/misNotas">mis Notas</a>
            </li>
            <li>
                <a href="/logout" aria-label="cerrar sesión"><i class="fa-solid fa-right-from-bracket"></i></a>
            </li>
        </ol>
    </div>
    <?php
}
?>

<h1>Inicio</h1>
<ol>
    <li><a href="/login">Login</a></li>
    <li><a href="/register">Register</a></li>
</ol>