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
        <?php
        if (Application::$app->session->getFlash('errorInsertar')) {
            ; ?>
            <div class="alert" style="margin-bottom:1em;">
                <div class="background danger">
                    <p>
                        <?php echo Application::$app->session->getFlash('errorInsertar'); ?>
                    </p>
                </div>
            </div>
            <?php
        }
        ?>
        <header>

            <!-- var_dump(Application::$app->user->id); -->
            <form action="/addNota" method="post" id="nuevaNota">
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

            <form action="" method="post" id="filtros">
                <h2>Filtrar por estados</h2>
                <ol id="estados">
                    <!-- <input type="checkbox" name="check_list[]" value="C/C++"><label>C/C++</label><br /> -->
                    <?php
                    if (isset($estados)) {
                        foreach ($estados as $estado) {
                            ?>
                            <li>
                                <label class="<?php echo $estado['clase']; ?>">
                                    <i class="fa-solid fa-thumbtack pin"></i>
                                    <?php echo $estado['estado']; ?>
                                    <input type="checkbox" name="estados[]" value="<?php echo $estado['id']; ?>">
                                </label>
                            </li>
                            <?php
                        }
                    }
                    ?>
                    <li>
                        <label class="marked_important">
                            <i class="fa-solid fa-thumbtack pin"></i>
                            Importantes
                            <input type="checkbox" name="importante" value="1">
                        </label>
                    </li>
                    <script>
                        //Cambiar estilo según están o no marcados
                        let estados = document.querySelectorAll("#estados input[type='checkbox']");

                        estados.forEach(element => {
                            element.addEventListener('change', function () {
                                element.checked ? element.parentElement.classList.toggle('checked') : element.parentElement.classList.toggle('checked');
                            })
                        });
                    </script>
                    <li><label class="no_started" aria-label="mostrar todas"><i class="fa-solid fa-thumbtack pin"></i><a
                                href="/misNotas">Todas</a></label></li>
                </ol>

                <!-- AUTOCOMPLETE -->

                <div id="buscarTitulo">
                    <i class="fa-solid fa-thumbtack pin"></i>
                    <h2>Buscar por título</h2>
                    <div id="search">
                        <input type="text" name="tituloNota" id="tituloNota" autoComplete="off">
                        <!-- MOSTRAR AQUÍ LOS RESULTADOS DEL AJAX -->
                        <div id="searchResults"></div>
                    </div>
                </div>
                <input type="submit" value="Buscar" id="buscar">
            </form>

            <script src="/resources/js/autoComplete.js"></script><!-- Autocomplete script -->

        </header>
        <?php
        if (count($notas) != 0) {
            ?>
            <section id="notes_container">
                <?php
                foreach ($notas as $nota) {
                    ?>
                    <div class="note <?php echo $nota['clase']; ?> <?php echo $nota['importante'] == 0 ? '' : 'marked_important'; ?>"
                        id="Note<?php echo $nota['id']; ?>">
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
                                <li><span class="markImportant"
                                        onclick="markAsImportant(<?php echo $nota['importante']; ?>,<?php echo $nota['id']; ?>)"><i
                                            class="fa-solid fa-circle-exclamation <?php echo $nota['importante'] == 0 ? '' : 'importante'; ?>"></i></span>
                                </li>
                                <li><span><strong>
                                            <?php echo $nota['estado']; ?>
                                        </strong></span></li>
                                <li><i class="fa-solid fa-wrench modify"
                                        onclick="editNote(<?php echo $nota['id']; ?>,<?php echo Application::$app->user->id; ?>)"></i>
                                </li>
                                <li><span onclick="deleteNote(<?php echo $nota['id']; ?>)">X</span></li>
                            </ol>
                        </footer>
                    </div>
                    <?php
                }
                ?>
                <script>
                    let notas = document.querySelectorAll('.note');
                    //console.log(location.protocol + '//' + location.host + '/');
                    function editNote(id, user) {
                        //this.parentElement.parentElement.parentElement.parentElement.classList.toggle('edit');
                        setTimeout(function () {
                            /*
                                location.protocol -> http/https
                                location.host -> localhost
                                location.port -> :8080
                            */
                            window.location.replace(location.protocol + '//' + location.host + `/misNotas/editarNota?id=${id}&usuario=${user}`);
                        }, 500);
                    }
                </script>
                <script>
                    //Marcar nota como importante
                    function markAsImportant(mark, noteID) {
                        $.ajax({
                            url: '/marcarImportante',
                            type: 'POST',
                            data: {
                                importante: mark,
                                id: noteID,
                            },
                            success: function (response) {
                                window.location.reload();
                                console.log('Elemento marcado');
                            },
                            error: function (error) {
                                console.log(JSON.parse(error.responseText).error);
                            }
                        });
                    }
                </script>
                <script src="/resources/js/borrarNota.js"></script>
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