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
                            sugerencias.innerHTML = "<ol><li>" + JSON.parse(error.responseText).error + "</li></ol>";
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