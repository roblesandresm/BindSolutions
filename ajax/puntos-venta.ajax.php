<?php

require_once "../controllers/puntos_venta.controller.php";
require_once "../models/puntos_venta.model.php";

class AjaxPuntosVenta {

    /**======================
    * EDITAR PUNTOS DE VENTA
    ========================*/

    public $idPuntoVenta;

    public function ajaxEditarPuntoVenta() {
        $item = "id";
        $valor = $this->idPuntoVenta;

        $respuesta = ControllerPuntosVenta::ctrMostrarPuntosVenta($item, $valor);

        echo json_encode($respuesta);
    }

    /*====================
     *  ACTIVAR O DESACTIVAR PUNTO DE VENTA =
    ====================*/
    public $idPuntoVentaAccion;
    public $estadoPuntoVenta;

    public function ajaxCambiarEstadoPV()
    {
        $tabla = "puntos_venta";
        $item1 = "estado";

        if ($this->estadoPuntoVenta == 1) {
            $valor1 = 2;
        } else if ($this->estadoPuntoVenta == 2) {
            $valor1 = 1;
        }

        $item2 = "id";
        $valor2 = $this->idPuntoVentaAccion;

        $respuesta = ModelPuntosVenta::mdlCambiarEstadoPV($tabla, $item1, $valor1, $item2, $valor2);
    }

    /*============================
     *  ELIMINAR PUNTO DE VENTA  =
    =============================*/
    public $idPuntoVentaEliminar;

    public function ajaxEliminarPuntoVenta()
    {
        $tabla = "puntos_venta";
        $item = "id";
        $id = $this->idPuntoVentaEliminar;

        $respuesta = ModelPuntosVenta::mdlEliminarPuntoVenta($tabla, $item, $id);
    }
}

/**======================
* EDITAR PUNTO DE VENTA
========================*/
if (isset($_POST['idPuntoVenta'])) {
    $editarPuntoVenta = new AjaxPuntosVenta();
    $editarPuntoVenta->idPuntoVenta = $_POST['idPuntoVenta'];
    $editarPuntoVenta->ajaxEditarPuntoVenta();    
}

/**======================
* CAMBIAR ESTADO PUNTO DE VENTA
========================*/
if (isset($_POST['idPuntoVentaAccion'])) {
    $cambiarEstadoPV = new AjaxPuntosVenta();
    $cambiarEstadoPV->idPuntoVentaAccion = $_POST['idPuntoVentaAccion'];
    $cambiarEstadoPV->estadoPuntoVenta = $_POST['estadoPuntoVenta'];
    $cambiarEstadoPV->ajaxCambiarEstadoPV();  
}

/*========================
*  ELIMINAR PUNTO VENTA  =
=========================*/
if (isset($_POST['idPuntoVentaEliminar'])) {
    $eliminarPuntoVenta = new AjaxPuntosVenta();
    $eliminarPuntoVenta->idPuntoVentaEliminar = $_POST['idPuntoVentaEliminar'];
    $eliminarPuntoVenta->ajaxEliminarPuntoVenta();    
}