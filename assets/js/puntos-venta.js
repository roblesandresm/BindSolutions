// EDITAR PUNTO DE VENTA
$(document).on('click', '.btnEditarPuntoVenta', function () {
    var idPuntoVenta = $(this).attr('idPuntoVenta');

    var datos = new FormData();
    datos.append('idPuntoVenta', idPuntoVenta);

    $.ajax({
        url: "ajax/puntos-venta.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            $('#editarPuntoVenta').val(respuesta['nombre']);
            $('#idPuntoVenta').val(respuesta['id']);
            $("#editarEventoPv").val(respuesta['id_evento']);
            $("#editarVendedorPv").val(respuesta['id_vendedor']);

            // traer nombre de evento
            var datosEvento = new FormData();
            datosEvento.append('idEvento', respuesta['id_evento']); 
            $.ajax({
                url: "ajax/eventos.ajax.php",
                method: "POST",
                data: datosEvento,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuesta) {
                    $("#editarEventoNombre").val(respuesta['nombre']);
                }
            });
            
            // traer nombre de vendedor
            var datosVendedor = new FormData();
            datosVendedor.append('idUsuario', respuesta['id_vendedor']); 
            $.ajax({
                url: "ajax/usuarios.ajax.php",
                method: "POST",
                data: datosVendedor,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuesta) {
                    $('#editarVendedorPv').html(respuesta['nombre']);
                }
            });
        },
        error: function (err) {
            console.log('error: ',err);
        }
    });

});

/**
* ELIMINADO LOGICO DE UN PUNTO DE VENTA
*/
$(document).on('click', '.btnEliminarPuntoVenta', function () {
    var idPuntoVenta = $(this).attr('idPuntoVenta');

    Swal.fire({
      title: 'Seguro que deseas eliminar el Punto de venta?',
      text: "Ya no podras volver a verlo en tu lista!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Eliminar!'
    }).then((result) => {

        if (result.isConfirmed) {
          
            var datos = new FormData();
            datos.append('idPuntoVentaEliminar', idPuntoVenta);

            $.ajax({
                url: "ajax/puntos-venta.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success: function (respuesta) {
                    Swal.fire(
                        'Eliminado!',
                        'El punto de venta ha sido Eliminado.',
                        'success'
                    )
                    window.location = 'puntos-venta';
                }
            });
        }

    })
    
});

/**
* ACTIVAR o DESACTIVAR PUNTO DE VENTA
*/
$(document).on('click', '.btnActivarPv', function () {
    var idPuntoVenta = $(this).attr('idPuntoVenta');
    var estadoPuntoVenta = $(this).attr('estadoPuntoVenta');

    if (estadoPuntoVenta == "1") {
        var acciones = ["Activar", "Activado", "Desactivar"];
        var titulo = 'Estas seguro de Desactivar el punto de venta?';
        var texto = 'Ya no podras hacer ventas';
    } else {
        var acciones = ["Desactivar", "Desactivado", "Activar"];
        var titulo = 'Seguro de activar el punto de venta?';
        var texto = 'Los productos volveran a estar disponibles';
    }

    Swal.fire({
      title: titulo,
      text: texto,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, ' + acciones[2]
    }).then((result) => {

        if (result.isConfirmed) {
          
            var datosActivar = new FormData();
            datosActivar.append('idPuntoVentaAccion', idPuntoVenta);
            datosActivar.append('estadoPuntoVenta', estadoPuntoVenta);
            

            $.ajax({
                url: "ajax/puntos-venta.ajax.php",
                method: "POST",
                data: datosActivar,
                cache: false,
                contentType: false,
                processData: false,
                success: function (respuesta) {
                    Swal.fire(
                        acciones[1] + '!',
                        'El Punto de venta ha sido ' + acciones[1],
                        'success'
                    )
                    window.location = 'puntos-venta';
                },
                error: function (err) {
                    console.log(err);
                }
            });
        }

    })
    
 });