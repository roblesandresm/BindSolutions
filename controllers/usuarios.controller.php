<?php

class ControllerUsuarios 
{

    /**
     * INGRESO DE USUARIO
     */
    public function ctrIngresoUsuario()
    {
        if (isset($_POST["ingUsuario"])) {
            /**
             * validacion de usuario
             */
            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) ||
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"])
            ) {
                $tabla = "usuarios";
                $item = "username";
                $valor = $_POST["ingUsuario"];

                $respuesta = ModelUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

                if (is_array($respuesta)) {
                    if($respuesta["username"] == $_POST["ingUsuario"] && 
                        $respuesta["password"] == $_POST["ingPassword"]
                    ) {
                        $_SESSION["iniciarSesion"] = "ok";
                        echo "<script>
                            window.location = 'inicio'
                        </script>";
                    } else {
                        echo "<div class='alert alert-danger'>La contraseña es incorrecta</div>";
                    }   
                } else {
                    echo "<div class='alert alert-danger'>Usuario y contraseña incorrectos</div>";
                }
            }
        }
    }
}