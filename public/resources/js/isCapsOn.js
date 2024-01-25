//Recoger los inputs de tipo 'password'
let inputPassword = document.querySelectorAll('[type="password"]');

//Mostrar mensaje cuando la tecla 'mayus' esté activa.
inputPassword.forEach(element => {
    element.addEventListener('keyup', function (event) {
        if (event.getModifierState('CapsLock')) {
            document.querySelector('#capsOn').innerHTML = '<strong>Mayúsculas activadas.</strong>';
        } else {
            document.querySelector('#capsOn').innerHTML = '';
        }
    })
});