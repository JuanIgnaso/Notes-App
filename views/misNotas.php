<?php
use app\core\Application;

$this->title = 'Mis Notas';
?>
<h1 style="text-align: center;">Mis Tareas Pendientes</h1>



<aside id="sidebarMenu">
    <div id="desktop">
        <h3>Menú de Usuario</h3>
        <ol>
            <li><a href="/">Inicio </a><i class="fa-solid fa-hand-point-left"></i></li>
            <li><a href="/perfil">Perfil </a><i class="fa-solid fa-hand-point-left"></i></li>
            <li><a href="/logout">Cerrar Sesión </a><i class="fa-solid fa-hand-point-left"></i></li>
        </ol>
    </div>
    <div id="phone">
        <button id="abrirMenu" onclick="openMobileMenu()" type="button"><i class="fa-solid fa-bars open"></i></button>
        <div id="mobileMenu">
            <h3>Menu de Usuario</h3>
            <ol>
                <li><a href="/">Inicio </a><i class="fa-solid fa-hand-point-left"></i></li>
                <li><a href="/perfil">Perfil </a><i class="fa-solid fa-hand-point-left"></i></li>
                <li><a href="/logout">Cerrar Sesión </a><i class="fa-solid fa-hand-point-left"></i></li>
            </ol>
        </div>
    </div>
    <script src="./resources/js/openSidebarMenu.js"></script>
</aside>
<main id="main_container">
    <div id="container_inner">
        <header>
            <!-- var_dump(Application::$app->user->id); -->
            <form action="/addNota" method="post">
                <i class="fa-solid fa-thumbtack pin"></i>
                <h2>Crear una Nota nueva</h2>
                <label>
                    Titulo
                    <input type="text" name="titulo" id="titulo">
                </label>
                <label>
                    Descripción
                    <textarea name="descripcion" id="descripcion" cols="30" rows="3"></textarea>
                </label>
                <input type="submit" value="Crear" id="crear">
            </form>


            <h2>Filtrar por estados</h2>
            <ol id="estados">
                <li><span class="no_started" aria-label="filtrar sin empezar"><i
                            class="fa-solid fa-thumbtack pin"></i>Sin empezar</span></li>
                <li><span class="in_progress" aria-label="filtrar empezadas"><i class="fa-solid fa-thumbtack pin"></i>En
                        progreso</span></li>
                <li><span class="paused" aria-label="filtrar pausadas"><i class="fa-solid fa-thumbtack pin"></i>En
                        Pausa</span></li>
                <li><span class="finished" aria-label="filtrar terminadas"><i
                            class="fa-solid fa-thumbtack pin"></i>Terminadas</span></li>
                <li><span class="no_started" aria-label="mostrar todas"><i
                            class="fa-solid fa-thumbtack pin"></i>Todas</span></li>
            </ol>
            <h2>Filtrar por Título</h2>

            <!-- AUTOCOMPLETE -->
            <form action="/getByTitle" method="post">
                <i class="fa-solid fa-thumbtack pin"></i>
                <input type="text" name="tituloNota" id="tituloNota">
                <input type="submit" value="Buscar" id="buscar">
            </form>
            <script>
                /*
                SCRIPT PARA RECIBIR SUGERENCIAS
                */

                document.querySelector('#tituloNota').addEventListener('keyup', function () {
                    let buscar = this.value;//texto que escribe el usuario
                    $.ajax({
                        url: '/getNotes',
                        type: 'POST',
                        data: {
                            titulo: buscar,
                        },
                        success: function (response) {
                            console.log(JSON.parse(response));
                        },
                        error: function (error) {
                            console.log(JSON.parse(error.responseText));
                        }
                    })
                });
            </script>

        </header>
        <?php
        if (count($notas) != 0) {
            ?>
            <section id="notes_container">
                <?php
                foreach ($notas as $nota) {
                    ?>
                    <div class="note <?php echo $nota['clase']; ?>">
                        <div class="tape">
                            <div class="tape_shade"></div>
                        </div>
                        <div class="noteContent">
                            <h3>
                                <?php echo $nota['titulo']; ?>
                            </h3>
                            <p>
                                <?php echo $nota['descripcion']; ?>
                            </p>
                        </div>
                        <footer class="actions">
                            <ol>
                                <li><span>!</span></li>
                                <li><span><strong>
                                            <?php echo $nota['estado']; ?>
                                        </strong></span></li>
                                <li><i class="fa-solid fa-wrench"></i></li>
                                <li><span onclick="deleteNote(<?php echo $nota['id']; ?>)">X</span></li>
                            </ol>
                        </footer>
                    </div>
                    <?php
                }
                ?>
                <script>
                    /*
                    SCRIPT PARA BORRAR LAS NOTAS
                    */
                    function deleteNote(id) {
                        $.ajax({
                            url: '/borrarNota',
                            type: 'POST',
                            data: {
                                id: id,
                            },
                            success: function (response) {
                                location.reload();
                                console.log('Elemento borrado');
                            },
                            error: function (error) {
                                location.reload();
                                console.log('error al borrar');
                            }
                        })
                    }
                </script>
            </section>
            <?php
        } else {
            ?>
            <div id="noNotes">
                <div class="danger">
                    <h3>No tienes ninguna nota creada en este momento</h3>
                </div>
            </div>
            <?php
        }
        ?>

    </div>
</main>