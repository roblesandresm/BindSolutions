/* EDITAR EVENTO */
$(document).on('click', '.btnEditarEvento', function () {
    var idEvento = $(this).attr('idEvento');

    var datos = new FormData();
    datos.append('idEvento', idEvento);

    $.ajax({
        url: "ajax/eventos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            $('#editarEvento').val(respuesta['nombre']);
            $('#editarUbicacion').val(respuesta['ubicacion']);
            $('#idEvento').val(respuesta['id']);
        
            if (respuesta['id_socio'] != null) {

                $('#editarSocio').val(respuesta['id_socio'])

                var datosSocio = new FormData();

                datosSocio.append('idUsuario', respuesta['id_socio']); 
                $.ajax({
                    url: "ajax/usuarios.ajax.php",
                    method: "POST",
                    data: datosSocio,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function (respuesta) {
                        $('#editarSocio').html(respuesta['nombre']);
                    }
                });
            } else {
                $('#editarSocio').val('');
                $('#editarSocio').html('-- Agrega un socio si asi lo deseas --');
            }
        },
        error: function (err) {
            console.log('error: ',err);
        }
    });

});

/**
 * TERMINAR UN EVENTO
 */
 $(document).on('click', '.btnActivo', function () {

    Swal.fire({
      title: 'Vas a terminar el evento?',
      text: "Ya no podras volver a iniciarlo!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Terminarlo!'
    }).then((result) => {

        if (result.isConfirmed) {
            var idEvento = $(this).attr('idEvento');
            console.log(idEvento);
          
            var datos = new FormData();
            datos.append('idEventoTerminar', idEvento);

            $.ajax({
                url: "ajax/eventos.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success: function (respuesta) {
                    Swal.fire(
                        'Terminado!',
                        'El evento ha sido terminado.',
                        'success'
                    )
                    window.location = 'eventos';
                }
            });
        }

    })
    
 });


/**
* ELIMADO LOGICO DE UN EVENTO
*/
$(document).on('click', '.btnEliminarEvento', function () {

    Swal.fire({
      title: 'Seguro que deseas eliminar el evento?',
      text: "Ya no podras volver a verlo en tu lista!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Eliminar!'
    }).then((result) => {

        if (result.isConfirmed) {
            var idEvento = $(this).attr('idEliminarEvento');
          
            var datos = new FormData();
            datos.append('idEliminarEvento', idEvento);

            $.ajax({
                url: "ajax/eventos.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success: function (respuesta) {
                    Swal.fire(
                        'Eliminado!',
                        'El evento ha sido Eliminado.',
                        'success'
                    )
                    window.location = 'eventos';
                }
            });
        }

    })
    
});