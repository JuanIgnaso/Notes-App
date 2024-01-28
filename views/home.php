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
                <h3>Crear Notas de tus tareas</h3>
                <p>Escribir notas de lo que necesites acordarte, con <strong>título, descripción y prioridad</strong>
                </p>
            </article>
            <article>
                <h3>Modificar su contenido</h3>
                <p>Podrás cambiar tanto el título como descripción, y estado según tu progreso sobre dicho objetivo.</p>
            </article>
            <article>
                <h3>Filtrar según características</h3>
                <p>Ayudarte a encontrar la Nota que buscas es importante, dentro de la aplicacíon podrás buscar por:</p>
                <ul>
                    <li>Título</li>
                    <li>Estado de la Nota</li>
                    <li>Separar las importantes</li>
                </ul>
            </article>
        </div>
    </section>
    <section id="unirse">
        <h2>Como puedes realizar dichas acciones?. 🗒️ </h2>
        <p>Puedes realizar estas operaciones registrándote en la aplicación, bien desde el menú del principio de la
            página o haciendo click aquí en Registrarse ahora.</p>
        <a href="/register">Registrar Cuenta<i class="fa-solid fa-pen-fancy"></i></a>
    </section>
</main>