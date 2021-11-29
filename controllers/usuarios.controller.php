<?php

class ControllerUsuarios 
{

    /**
     * INGRESO DE USUARIO
     */
    static public function ctrIngresoUsuario()
    {
        if (isset($_POST["ingUsuario"])) {
            /**
             * validacion de usuario
             */
            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) ||
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])
            ) {
                $encriptarPassword = crypt($_POST['ingPassword'] , '$2a$07$usesomesillystringforsalt$');

                $tabla = "usuarios";
                $item = "username";
                $valor = $_POST["ingUsuario"];

                $respuesta = ModelUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

                if (is_array($respuesta)) {
                    if($respuesta["username"] == $_POST["ingUsuario"] && 
                        $respuesta["password"] == $encriptarPassword
                    ) {

                        if ($respuesta['estado'] == 1) {
                            /**
                             * VARIABLES DE SESION
                            */
                            $_SESSION["iniciarSesion"] = "ok";
                            $_SESSION["id"] = $respuesta['id'];
                            $_SESSION["nombre"] = $respuesta['nombre'];
                            $_SESSION["username"] = $respuesta['username'];
                            $_SESSION["foto"] = $respuesta['foto'];
                            $_SESSION["tipo"] = $respuesta['tipo'];

                            echo "<script>
                                window.location = 'inicio'
                            </script>";

                        } else {
                            echo "<div class='alert alert-danger'>El usuario aun no esta activado</div>";
                        }
                        
                    } else {
                        echo "<div class='alert alert-danger'>La contraseña es incorrecta</div>";
                    }   
                } else {
                    echo "<div class='alert alert-danger'>Usuario y contraseña incorrectos</div>";
                }
            }
        }
    }

    /**======================
     * REGISTRO DE USUARIO  =
    ========================*/
    static public function ctrCrearUsuario()
    {
        if(isset($_POST["nuevoUsuario"])){

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])) {
                
                /*==========================
                 * VALIDANDO IMAGEN
                ===========================*/

                $ruta = "";

				if(isset($_FILES["nuevaFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "views/img/usuarios/".$_POST["nuevoUsuario"];

					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "views/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "views/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

                $tabla = 'usuarios';

                $encriptarPassword = crypt($_POST['nuevoPassword'] , '$2a$07$usesomesillystringforsalt$');
                
                $datos = array('nombre'=> $_POST['nuevoNombre'],
                        'username'=> $_POST['nuevoUsuario'],
                        'password'=> $encriptarPassword,
                        'tipo'=> $_POST['nuevoTipo'],
                        'foto'=> $ruta);

                $respuesta = ModelUsuarios::mdlCrearUsuario($tabla, $datos);

                if ($respuesta == 'ok') {
                    echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "El usuario se ha creado exitosamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }).then(result => {
                            if(result.value){
                                window.location = "usuarios";
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
                        title: "El usuario no puede ir vacio o llevar caracteres especiales",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    }).then(result => {
                        if(result.value){
                            window.location = "usuarios";
                        }
                    });
                </script>';
            }

        }
    }

    /**==========================
     * MOSTRAR USUARIO
    ==============================*/
    static public function ctrMostrarUsuario($item, $valor) {

        $tabla = 'usuarios';
        $respuesta = ModelUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

        return $respuesta;
    }

    /**==========================
     * EDITAR USUARIO
    ==============================*/
    static public function ctrEditarUsuario() {
        
        if (isset($_POST['editarUsuario'])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])) {

                # VALIDAR IMAGEN
                $ruta = $_POST["fotoActual"];

                if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "views/img/usuarios/".$_POST["editarUsuario"];

                    /*=============================================
					PREGUNTAMONS SI EXITE OTRA IMAGEN ALMACENADA PARA EL USUARIO
					=============================================*/
                    if (!empty($_POST['fotoActual'])) {
                        unlink($_POST['fotoActual']);
                    } else {
                        mkdir($directorio, 0755);
                    }

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "views/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "views/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

                $tabla = 'usuarios';
                $passwordActual = $_POST['passwordActual'];

                if ($_POST['editarPassword'] != "") {

                    if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])) {
                        $encriptarPassword = crypt($_POST['editarPassword'] , '$2a$07$usesomesillystringforsalt$');
                    } else {
                        echo '<script>
                            Swal.fire({
                                icon: "error",
                                title: "la contraseña no puede contener caracteres especiales",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            }).then(result => {
                                if(result.value){
                                    window.location = "usuarios";
                                }
                            });
                        </script>';
                    }

                } else {
                    $encriptarPassword = $passwordActual;
                }

                $datos = array('nombre' => $_POST['editarNombre'],
                'username' => $_POST['editarUsuario'],
                'password' => $encriptarPassword,
                'tipo' => $_POST['editarTipo'],
                'foto' => $ruta);

                $respuesta = ModelUsuarios::mdlEditarUsuario($tabla, $datos);

                if ($respuesta == 'ok') {
                    echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "El usuario se ha actualizado exitosamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }).then(result => {
                            if(result.value){
                                window.location = "usuarios";
                            }
                        });
                    </script>'; 
                }

            } else {
                echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "El nombre no puede ir vacio o contener caracteres especiales",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }).then(result => {
                            if(result.value){
                                window.location = "usuarios";
                            }
                        });
                    </script>'; 
            }
        }
    }
}