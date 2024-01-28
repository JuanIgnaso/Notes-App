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
                <li><span class="no_started" aria-label="mostrar todas"><i class="fa-solid fa-thumbtack pin"></i><a
                            href="/misNotas">Todas</a></span></li>
            </ol>
            <h2>Filtrar por Título</h2>

            <!-- AUTOCOMPLETE -->
            <form action="" method="post" id="buscarTitulo">
                <i class="fa-solid fa-thumbtack pin"></i>
                <div id="search">
                    <input type="text" name="tituloNota" id="tituloNota" autoComplete="off">
                    <!-- MOSTRAR AQUÍ LOS RESULTADOS DEL AJAX -->
                    <div id="searchResults"></div>
                    <input type="submit" value="Buscar" id="buscar">
            </form>
            <script>
                /*
                SCRIPT PARA RECIBIR SUGERENCIAS
                */
                let userInput = document.querySelector('#tituloNota');
                let sugerencias = document.querySelector('#searchResults');

                function autoComplete(value) {
                    document.querySelector('#tituloNota').value = value;
                }


                // userInput.addEventListener('focusout', function () {
                //     sugerencias.innerHTML = '';
                // });

                userInput.addEventListener('keyup', function () {
                    let buscar = this.value;//texto que escribe el usuario
                    $.ajax({
                        url: '/getNotes',
                        type: 'POST',
                        data: {
                            titulo: buscar,
                        },
                        success: function (response) {
                            let resp = JSON.parse(response).map((x) => x.titulo);//Lista de titulos
                            print(resp);
                            console.log(resp);
                        },
                        error: function (error) {
                            sugerencias.innerHTML = "<ol><li>Sin resultados...</li></ol>";
                            console.log(JSON.parse(error.responseText));
                        }
                    })
                });



                function print(data) {
                    sugerencias.innerHTML = '';
                    let list = document.createElement("ol");
                    data.forEach(element => {
                        let item = document.createElement('li');
                        item.setAttribute('onclick', 'autoComplete(this.innerHTML)');
                        let content = document.createTextNode(element);
                        item.appendChild(content);
                        list.appendChild(item);

                    });
                    sugerencias.appendChild(list);
                }
            </script>

        </header>
        <?php
        if (count($notas) != 0) {
            ?>
            <section id="notes_container">
                <?php
                foreach ($notas as $nota) {
                    ?>
                    <div class="note <?php echo $nota['clase']; ?>" id="Note<?php echo $nota['id']; ?>">
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
                                //Elimina el elemento del DOM si este es borrado de la BBDD
                                let element = document.getElementById("Note" + id);
                                element.remove();
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