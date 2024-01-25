/*
FUNCION - Abrir el menú cuando el usuario hace click en el icono, cerrarlo cuando hace click fuera del menú.
*/
let menu = document.querySelector('#mobileMenu');


function openMobileMenu() {
    menu.classList.add('mostrar');
}

window.onclick = function (event) {
    if (!event.target.matches('.open')) {
        if (menu.classList.contains('mostrar')) {
            menu.classList.remove('mostrar');
        }
    }
}