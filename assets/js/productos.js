
/**
 * SUBIENDO LA IMAGEN DEL PRODUCTO
 */
$(".nuevaImagen").change(function () {
    let imagen = this.files[0];

    if (imagen['type'] != "image/jpeg" &&
        imagen['type'] != "image/png") {
        
        $('.nuevaImagen').val('');

        Swal.fire({
            icon: "error",
            title: "Error al subir la foto",
            text: "La imagen debe estar en formato JPG o PNG!",
            confirmButtonText: "Cerrar"
        });

    } else if (imagen['size'] > 2000000) {
        $('.nuevaImagen').val('');

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

/* EDITAR PRODUCTO */
$(document).on('click', '.btnEditarProducto', function () {
    var idProducto = $(this).attr('idProducto');

    var datos = new FormData();
    datos.append('idProducto', idProducto);

    $.ajax({
        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log("respuesta: ", respuesta);
            $('#editarProducto').val(respuesta['nombre']);
            $('#idProducto').val(respuesta['id']);
            $('#editarPrecioCompra').val(respuesta['precio_compra']);
            $('#editarPrecioVenta').val(respuesta['precio_venta']);
            $('#imagenActual').val(respuesta['foto']);

            if (respuesta['foto'] != "") {
                $('#imagenActual').val(respuesta['foto']);
                $('.previsualizar').attr('src', respuesta['foto']);
            }
        }
    });

});


/* ELIMINAR PRODUCTO */
$(document).on('click', '.btnEliminarProducto', function () {
    var idProducto = $(this).attr('idProducto');
    console.log(idProducto);

    var datos = new FormData();
    datos.append('idEliminarProducto', idProducto);

    $.ajax({
        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta === "ok") {
                Swal.fire({
                    icon: "success",
                    title: "El producto se ha Eliminado",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                }).then(result => {
                    if(result.value){
                        window.location = "productos";
                    }
                });
            }
        }
    });

});