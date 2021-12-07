<?php

class ControllerEventos
{
    /**=================================
     * MOSTRAR EVENTOS
     ==================================*/

    static public function ctrMostrarEventos($item, $valor) {
        $tabla = 'eventos';
        $respuesta = ModelEventos::mdlMostrarEventos($tabla, $item, $valor);

        return $respuesta;
    } 

    /**=================================
    * CREAR EVENTOS
    ==================================*/
    static public function ctrCrearEvento() {

        if (isset($_POST["nuevoEvento"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoEvento"])  &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaUbicacion"])) {
    
                /**==================================
                 * VALIDAR LA IMAGEN
                 ===================================*/
                if (empty($_POST['nuevoSocio'])) {
                    $socio = null;
                } else {
                    $socio = $_POST['nuevoSocio'];
                }
    
                $tabla = 'eventos';
    
                $datos = array('nombre' => $_POST['nuevoEvento'], 
                                'id_socio' => $socio,
                                'ubicacion' => $_POST['nuevaUbicacion']);
    
    
                $respuesta = ModelEventos::mdlCrearEvento($tabla, $datos);
    
                if ($respuesta == 'ok') {
                    echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "El evento se ha creado exitosamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }).then(result => {
                            if(result.value){
                                window.location = "eventos";
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
                        title: "El nombre del evento no puede ir vacio o llevar caracteres especiales",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    }).then(result => {
                        if(result.value){
                            window.location = "eventos";
                        }
                    });
                </script>';
            }
        } 
    }
    
}
