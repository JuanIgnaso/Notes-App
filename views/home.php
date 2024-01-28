<?php
use app\core\Application;

$this->title = 'Inicio';
?>


<div id="menuUsuario">
    <ol>
        <?php
        if (!Application::isGuest()) {
            ?>
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
            <?php
        } else {
            ?>
            <li><a href="/login">Login</a></li>
            <li>/</li>
            <li><a href="/register">Registrarse</a></li>
            <?php
        }
        ?>
    </ol>
</div>

<main>
    <h1>My notes app - tu aplicación de notas</h1>
    <section id="objetivo">
        <h2>De que se trata esta aplicación?. 🎯</h2>
        <p>No te ocurre, que a veces tienes pendiente hacer o realizar una tarea y no te acuerdas?, en esta aplicación
            no tendrás este problema, a través de una cuenta de usuario podrás apuntar y crear esas cosas que tú tienes
            pendientes, accede a tu menú de Notas y escribe lo que consideres importante para tí.</p>
    </section>
    <section id="funciones">
        <h2>Funciones que puedes realizar. 🤔</h2>
        <p>En My Notes App puedes hacer las siguientes funciones dentro de la aplicación:</p>
        <div id="funcionesLista">
            <article>
                <h3>Funcion 1</h3>
            </article>
            <article>
                <h3>Funcion 2</h3>
            </article>
            <article>
                <h3>Funcion 3</h3>
            </article>
        </div>
    </section>
    <section id="unirse">
        <h2>Como puedes realizar dichas acciones?. 🗒️ </h2>
        <p>Puedes realizar estas operaciones registrándote en la aplicación, bien desde el menú del principio de la
            página o haciendo click aquí en Registrarse ahora.</p>
    </section>
</main>