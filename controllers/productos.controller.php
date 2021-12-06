<?php 

class ControllerProductos {

    /**==========================
    * EDITAR PRODUCTO           =
    ===========================*/
    static public function ctrEditarProducto() {
        
        if (isset($_POST["editarProducto"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarProducto"])  &&
                preg_match('/^[0-9]+$/', $_POST["editarPrecioCompra"]) &&
                preg_match('/^[0-9]+$/', $_POST["editarPrecioVenta"])) {

                /**==================================
                 * VALIDAR LA IMAGEN
                 ===================================*/

                $ruta = $_POST['imagenActual'];

                if(isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL PRODUCTO
					=============================================*/

                    $nombreDirectorio = str_replace(" ", "-", $_POST["editarProducto"]);
					$directorio = "views/img/productos/".$nombreDirectorio;

                    /*=============================================
					PREGUNTAMONS SI EXITE OTRA IMAGEN ALMACENADA PARA EL PRODUCTO EN LA DB
					=============================================*/
                    if (!empty($_POST['imagenActual']) && $_POST['imagenActual'] != 'views/img/productos/default/anonymoues.png') {
                        unlink($_POST['imagenActual']);
                    } else {
                        mkdir($directorio, 0755);
                    }

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarImagen"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "views/img/productos/".$nombreDirectorio."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarImagen"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "views/img/productos/".$nombreDirectorio."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

                $tabla = 'productos';

                $precioCompra = $_POST['editarPrecioCompra'];
                $precioVenta = $_POST['editarPrecioVenta'];

                $datos = array('nombre' => $_POST['editarProducto'], 
                                'precio_compra' => $precioCompra,
                                'precio_venta' => $precioVenta,
                                'foto' => $ruta,
                                'id' => $_POST['idProducto']);


                $respuesta = ModelProductos::mdlEditarProducto($tabla, $datos);

                if ($respuesta == 'ok') {
                    echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "El producto se ha Editado exitosamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }).then(result => {
                            if(result.value){
                                window.location = "productos";
                            }
                        });
                    </script>';    
                }
                
            } else {
                /**
                 * alerta Error al ingresar datos
                 */
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Precio de Venta Y Precio de compra no pueden contener puntos, ni ser negativos",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    }).then(result => {
                        if(result.value){
                            window.location = "productos";
                        }
                    });
                </script>';
            }

        }
    }

    /**==========================
    * CREAR PRODUCTOS           =
    ===========================*/
    static public function ctrCrearProducto() {
        
        if (isset($_POST["nuevoProducto"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoProducto"])  &&
                preg_match('/^[0-9]+$/', $_POST["nuevoPrecioCompra"]) &&
                preg_match('/^[0-9]+$/', $_POST["nuevoPrecioVenta"])) {

                /**==================================
                 * VALIDAR LA IMAGEN
                 ===================================*/

                $ruta = "views/img/productos/default/anonymous.png";

                if(isset($_FILES["nuevaImagen"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL PRODUCTO
					=============================================*/

                    $nombreDirectorio = str_replace(" ", "-", $_POST["nuevoProducto"]);
					$directorio = "views/img/productos/".$nombreDirectorio;

					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["nuevaImagen"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "views/img/productos/".$nombreDirectorio."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaImagen"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "views/img/productos/".$nombreDirectorio."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

                $tabla = 'productos';

                $precioCompra = $_POST['nuevoPrecioCompra'];
                $precioVenta = $_POST['nuevoPrecioVenta'];

                $datos = array('nombre' => $_POST['nuevoProducto'], 
                                'precio_compra' => $precioCompra,
                                'precio_venta' => $precioVenta,
                                'foto' => $ruta);


                $respuesta = ModelProductos::mdlCrearProducto($tabla, $datos);

                if ($respuesta == 'ok') {
                    echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "El producto se ha creado exitosamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }).then(result => {
                            if(result.value){
                                window.location = "productos";
                            }
                        });
                    </script>';    
                } else {
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "El producto no se pudo crear",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }).then(result => {
                            if(result.value){
                                window.location = "productos";
                            }
                        });
                    </script>';
                }
                
            } else {
                /**
                 * alerta Error al ingresar datos
                 */
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "El producto no puede ir vacio o llevar caracteres especiales",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    }).then(result => {
                        if(result.value){
                            window.location = "productos";
                        }
                    });
                </script>';
            }

        }
    }

    /**==========================
     * MOSTRAR PRODUCTOS
    ============================*/
    static public function ctrMostrarProductos($item, $valor) {

        $tabla = 'productos';
        $respuesta = ModelProductos::mdlMostrarProductos($tabla, $item, $valor);

        return $respuesta;
    }

    /**==========================
     * ELIMINAR PRODUCTOS
    ============================*/
    static public function ctrEliminarProducto($item, $valor) {

        $tabla = 'productos';
        $respuesta = ModelProductos::mdlEliminarProducto($tabla, $item, $valor);

        return $respuesta;
    }

}