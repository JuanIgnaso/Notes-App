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
            <li><a href="/login.html">Cerrar Sesión </a><i class="fa-solid fa-hand-point-left"></i></li>
        </ol>
    </div>
    <div id="phone">
        <button id="abrirMenu" onclick="openMobileMenu()" type="button"><i class="fa-solid fa-bars open"></i></button>
        <div id="mobileMenu">
            <h3>Menu de Usuario</h3>
            <ol>
                <li><a href="/">Inicio </a><i class="fa-solid fa-hand-point-left"></i></li>
                <li><a href="/perfil">Perfil </a><i class="fa-solid fa-hand-point-left"></i></li>
                <li><a href="/login.html">Cerrar Sesión </a><i class="fa-solid fa-hand-point-left"></i></li>
            </ol>
        </div>
    </div>
    <script src="./resources/js/openSidebarMenu.js"></script>
</aside>
<main id="main_container">
    <div id="container_inner">
        <header>
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

            <form autocomplete="off" action="/getNotesByTitle" method="post">

            </form>

        </header>
        <section id="notes_container">
            <div class="note paused">
                <div class="tape">
                    <div class="tape_shade"></div>
                </div>
                <div class="noteContent">
                    <h3>Descripción de la tarea hola hola</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales metus vitae eleifend
                        pretium. Aliquam erat volutpat. Ut scelerisque turpis massa, non rhoncus tortor laoreet eget.
                        Phasellus dapibus eros et tortor consectetur finibus. Donec tincidunt eu felis in egestas.</p>
                </div>
                <footer class="actions">
                    <ol>
                        <li><span>!</span></li>
                        <li><span><strong>En Pausa</strong></span></li>
                        <li><i class="fa-solid fa-wrench"></i></li>
                        <li><span>X</span></li>
                    </ol>
                </footer>
            </div>
            <div class="note in_progress">
                <div class="tape">
                    <div class="tape_shade"></div>
                </div>
                <div class="noteContent">
                    <h3>Descripción de la tarea hola hola</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales metus vitae eleifend
                        pretium. Aliquam erat volutpat. Ut scelerisque turpis massa, non rhoncus tortor laoreet eget.
                        Phasellus dapibus eros et tortor consectetur finibus. Donec tincidunt eu felis in egestas.</p>
                </div>
                <footer class="actions">
                    <ol>
                        <li><span>!</span></li>
                        <li><span><strong>En Progreso</strong></span></li>
                        <li><i class="fa-solid fa-wrench"></i></li>
                        <li><span>X</span></li>
                    </ol>
                </footer>
            </div>
            <div class="note finished">
                <div class="tape">
                    <div class="tape_shade"></div>
                </div>
                <div class="noteContent">
                    <h3>Descripción de la tarea hola hola</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales metus vitae eleifend
                        pretium. Aliquam erat volutpat. Ut scelerisque turpis massa, non rhoncus tortor laoreet eget.
                        Phasellus dapibus eros et tortor consectetur finibus. Donec tincidunt eu felis in egestas.</p>
                </div>
                <footer class="actions">
                    <ol>
                        <li><span>!</span></li>
                        <li><span><strong>Terminada</strong></span></li>
                        <li><i class="fa-solid fa-wrench"></i></li>
                        <li><span>X</span></li>
                    </ol>
                </footer>
            </div>
            <div class="note">
                <div class="tape">
                    <div class="tape_shade"></div>
                </div>
                <div class="noteContent">
                    <h3>Descripción de la tarea hola hola</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales metus vitae eleifend
                        pretium. Aliquam erat volutpat. Ut scelerisque turpis massa, non rhoncus tortor laoreet eget.
                        Phasellus dapibus eros et tortor consectetur finibus. Donec tincidunt eu felis in egestas.</p>
                </div>
                <footer class="actions">
                    <ol>
                        <li><span>!</span></li>
                        <li><span><strong>En Pausa</strong></span></li>
                        <li><i class="fa-solid fa-wrench"></i></li>
                        <li><span>X</span></li>
                    </ol>
                </footer>
            </div>
            <div class="note">
                <div class="tape">
                    <div class="tape_shade"></div>
                </div>
                <div class="noteContent">
                    <h3>Descripción de la tarea hola hola</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales metus vitae eleifend
                        pretium. Aliquam erat volutpat. Ut scelerisque turpis massa, non rhoncus tortor laoreet eget.
                        Phasellus dapibus eros et tortor consectetur finibus. Donec tincidunt eu felis in egestas. Cras
                        sollicitudin blandit elit, nec gravida libero maximus ac placerat. </p>
                </div>
                <footer class="actions">
                    <ol>
                        <li><span>!</span></li>
                        <li><span><strong>En Pausa</strong></span></li>
                        <li><i class="fa-solid fa-wrench"></i></li>
                        <li><span>X</span></li>
                    </ol>
                </footer>
            </div>
            <div class="note">
                <div class="tape">
                    <div class="tape_shade"></div>
                </div>
                <div class="noteContent">
                    <h3>Descripción de la tarea hola hola</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales metus vitae eleifend
                        pretium. Aliquam erat volutpat. Ut scelerisque turpis massa, non rhoncus tortor laoreet eget.
                        Phasellus dapibus eros et tortor consectetur finibus. Donec tincidunt eu felis in egestas.</p>
                </div>
                <footer class="actions">
                    <ol>
                        <li><span>!</span></li>
                        <li><span><strong>En Pausa</strong></span></li>
                        <li><i class="fa-solid fa-wrench"></i></li>
                        <li><span>X</span></li>
                    </ol>
                </footer>
            </div>
            <div class="note">
                <div class="tape">
                    <div class="tape_shade"></div>
                </div>
                <div class="noteContent">
                    <h3>Descripción de la tarea hola hola</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales metus vitae eleifend
                        pretium. Aliquam erat volutpat. Ut scelerisque turpis massa, non rhoncus tortor laoreet eget.
                        Phasellus dapibus eros et tortor consectetur finibus. Donec tincidunt eu felis in egestas.</p>
                </div>
                <footer class="actions">
                    <ol>
                        <li><span>!</span></li>
                        <li><span><strong>En Pausa</strong></span></li>
                        <li><i class="fa-solid fa-wrench"></i></li>
                        <li><span>X</span></li>
                    </ol>
                </footer>
            </div>
            <div class="note">
                <div class="tape">
                    <div class="tape_shade"></div>
                </div>
                <div class="noteContent">
                    <h3>Descripción de la tarea hola hola</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales metus vitae eleifend
                        pretium. Aliquam erat volutpat. Ut scelerisque turpis massa, non rhoncus tortor laoreet eget.
                        Phasellus dapibus eros et tortor consectetur finibus. Donec tincidunt eu felis in egestas.</p>
                </div>
                <footer class="actions">
                    <ol>
                        <li><span>!</span></li>
                        <li><span><strong>En Pausa</strong></span></li>
                        <li><i class="fa-solid fa-wrench"></i></li>
                        <li><span>X</span></li>
                    </ol>
                </footer>
            </div>
            <div class="note">
                <div class="tape">
                    <div class="tape_shade"></div>
                </div>
                <div class="noteContent">
                    <h3>Descripción de la tarea hola hola</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales metus vitae eleifend
                        pretium. Aliquam erat volutpat. Ut scelerisque turpis massa, non rhoncus tortor laoreet eget.
                        Phasellus dapibus eros et tortor consectetur finibus. Donec tincidunt eu felis in egestas.</p>
                </div>
                <footer class="actions">
                    <ol>
                        <li><span>!</span></li>
                        <li><span><strong>En Pausa</strong></span></li>
                        <li><i class="fa-solid fa-wrench"></i></li>
                        <li><span>X</span></li>
                    </ol>
                </footer>
            </div>
            <div class="note">
                <div class="tape">
                    <div class="tape_shade"></div>
                </div>
                <div class="noteContent">
                    <h3>Descripción de la tarea hola hola</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales metus vitae eleifend
                        pretium. Aliquam erat volutpat. Ut scelerisque turpis massa, non rhoncus tortor laoreet eget.
                        Phasellus dapibus eros et tortor consectetur finibus. Donec tincidunt eu felis in egestas.</p>
                </div>
                <footer class="actions">
                    <ol>
                        <li><span>!</span></li>
                        <li><span><strong>En Pausa</strong></span></li>
                        <li><i class="fa-solid fa-wrench"></i></li>
                        <li><span>X</span></li>
                    </ol>
                </footer>
            </div>
            <div class="note">
                <div class="tape">
                    <div class="tape_shade"></div>
                </div>
                <div class="noteContent">
                    <h3>Descripción de la tarea hola hola</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales metus vitae eleifend
                        pretium. Aliquam erat volutpat. Ut scelerisque turpis massa, non rhoncus tortor laoreet eget.
                        Phasellus dapibus eros et tortor consectetur finibus. Donec tincidunt eu felis in egestas.</p>
                </div>
                <footer class="actions">
                    <ol>
                        <li><span>!</span></li>
                        <li><span><strong>En Pausa</strong></span></li>
                        <li><i class="fa-solid fa-wrench"></i></li>
                        <li><span>X</span></li>
                    </ol>
                </footer>
            </div>
            <div class="note">
                <div class="tape">
                    <div class="tape_shade"></div>
                </div>
                <div class="noteContent">
                    <h3>Descripción de la tarea hola hola</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales metus vitae eleifend
                        pretium. Aliquam erat volutpat. Ut scelerisque turpis massa, non rhoncus tortor laoreet eget.
                        Phasellus dapibus eros et tortor consectetur finibus. Donec tincidunt eu felis in egestas.</p>
                </div>
                <footer class="actions">
                    <ol>
                        <li><span>!</span></li>
                        <li><span><strong>En Pausa</strong></span></li>
                        <li><i class="fa-solid fa-wrench"></i></li>
                        <li><span>X</span></li>
                    </ol>
                </footer>
            </div>
            <div class="note">
                <div class="tape">
                    <div class="tape_shade"></div>
                </div>
                <div class="noteContent">
                    <h3>Descripción de la tarea hola hola</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales metus vitae eleifend
                        pretium. Aliquam erat volutpat. Ut scelerisque turpis massa, non rhoncus tortor laoreet eget.
                        Phasellus dapibus eros et tortor consectetur finibus. Donec tincidunt eu felis in egestas.</p>
                </div>
                <footer class="actions">
                    <ol>
                        <li><span>!</span></li>
                        <li><span><strong>En Pausa</strong></span></li>
                        <li><i class="fa-solid fa-wrench"></i></li>
                        <li><span>X</span></li>
                    </ol>
                </footer>
            </div>
        </section>
    </div>
</main>