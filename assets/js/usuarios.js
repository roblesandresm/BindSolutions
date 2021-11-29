/** 
 * Subiendo la foto del usuaria
*/

$(".nuevaFoto").change(function () {
    let imagen = this.files[0];
    console.log(imagen);
    if (imagen['type'] != "image/jpeg" &&
        imagen['type'] != "image/png") {
        
        $('.nuevaFoto').val('');

        Swal.fire({
            icon: "error",
            title: "Error al subir la foto",
            text: "La imagen debe estar en formato JPG o PNG!",
            confirmButtonText: "Cerrar"
        });

    } else if (imagen['size'] > 2000000) {
        $('.nuevaFoto').val('');

        Swal.fire({
            icon: "error",
            title: "Error al subir la foto",
            text: "La imagen debe pesar menos de 2MB",
            confirmButtonText: "Cerrar"
        });
    } else {
        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on('load', (event) => {
            let rutaImagen = event.target.result;
            $('.previsualizar').attr('src', rutaImagen);
        });
    }
});

/* EDITAR USUARIO */
$(document).on('click', '.btnEditarUsuario', function () {
    var idUsuario = $(this).attr('idUsuario');

    var datos = new FormData();
    datos.append('idUsuario', idUsuario);

    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            $('#editarNombre').val(respuesta['nombre']);
            $('#editarUsuario').val(respuesta['username']);
            $('#editarPerfil').html(respuesta['tipo']);
            $('#editarPerfil').val(respuesta['tipo']);
            $('#passwordActual').val(respuesta['password']);
            $('#fotoActual').val(respuesta['foto']);

            if (respuesta['foto'] != "") {
                $('.previsualizar').attr('src', respuesta['foto']);
            }
        }
    });

});

/* ACTIVAR USUARIO */
$(document).on('click', '.btnActivar', function () {
    var idUsuario = $(this).attr('idUsuario');
    var estadoUsuario = $(this).attr('estadoUsuario');

    var datos = new FormData();
    datos.append('activarId', idUsuario);
    datos.append('activarUsuario', estadoUsuario);

    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            if(window.matchMedia("(max-width:767px)").matches){
		
                swal({
                   title: "El usuario ha sido actualizado",
                   type: "success",
                   confirmButtonText: "¡Cerrar!"
                 }).then(function(result) {
                 
                     if (result.value) {
 
                     window.location = "usuarios";
 
                 }
 
               });
            }
        }
    });

    if (estadoUsuario == 0) {
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('estadoUsuario', 1);
    } else {
        $(this).removeClass('btn-danger');
        $(this).addClass('btn-success');
        $(this).html('Activado');
        $(this).attr('estadoUsuario', 0);
    }

});


/* REVISAR SI EL USUARIO YA ESTA REGISTRADO */
$('#nuevoUsuario').change(function () {

    $('.alert').remove();
    
    var usuario = $(this).val();

    var datos = new FormData();
    datos.append('validarUsuario', usuario);

    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (respuesta) {
            if (respuesta) {
                $('#nuevoUsuario').parent().after('<div class="alert alert-warning">Este usuario ya existe, por favor intenta con otro</div>');
                $('#nuevoUsuario').val("");
            }
        }
    });
});