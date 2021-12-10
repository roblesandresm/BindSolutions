<?php

class ControllerPuntosVenta
{
    /**=================================
     * MOSTRAR PUNTOS DE VENTA
     ==================================*/

    static public function ctrMostrarPuntosVenta($item, $valor) {
        $tabla = 'puntos_venta';
        $respuesta = ModelPuntosVenta::mdlMostrarPuntosVenta($tabla, $item, $valor);
        return $respuesta;
    }

    /**=================================
     * CREAR PUNTO DE VENTA
     ==================================*/

    static public function ctrCrearPuntoVenta() {
        if (isset($_POST['nuevoEventoPv'])) {
            
            // generar nombre del evento random
            $numeroRandom = rand(0,1000);
            $nombrePuntoVenta = 'puntoventa-'.$numeroRandom;

            $tabla = 'puntos_venta';
            
            $datos = array('nombre' => $nombrePuntoVenta,
                            'evento' => $_POST['nuevoEventoPv'],
                            'vendedor' => $_POST['nuevoVendedorPv']);
            
            $respuesta = ModelPuntosVenta::mdlCrearPuntoVenta($tabla, $datos);

            if ($respuesta == 'ok') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Punto de venta creado exitosamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    }).then(result => {
                        if(result.value){
                            window.location = "puntos-venta";
                        }
                    });
                </script>';    
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Ocurrio un error al ingresar los datos",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    }).then(result => {
                        if(result.value){
                            window.location = "puntos-venta";
                        }
                    });
                </script>';
            }
        }
    }

    /**=================================
     * EDITAR PUNTO DE VENTA
     ==================================*/

     static public function ctrEditarPuntoVenta() {
        if (isset($_POST['editarEventoPv'])) {
            
            $nombrePuntoVenta = $_POST['editarPuntoVenta'];

            $tabla = 'puntos_venta';
            
            $datos = array('id' => $_POST['idPuntoVenta'],
                            'nombre' => $nombrePuntoVenta,
                            'id_evento' => $_POST['editarEventoPv'],
                            'id_vendedor' => $_POST['editarVendedorPv']);
            
            $respuesta = ModelPuntosVenta::mdlEditarPuntoVenta($tabla, $datos);

            if ($respuesta == 'ok') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Punto de venta se ha editado exitosamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    }).then(result => {
                        if(result.value){
                            window.location = "puntos-venta";
                        }
                    });
                </script>';    
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Ocurrio un error al ingresar los datos",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    }).then(result => {
                        if(result.value){
                            window.location = "puntos-venta";
                        }
                    });
                </script>';
            }
        }
    }
}