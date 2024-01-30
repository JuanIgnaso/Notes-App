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