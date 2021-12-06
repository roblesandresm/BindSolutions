<?php

require_once "../controllers/productos.controller.php";
require_once "../models/productos.model.php";

class AjaxProductos {

    /**======================
    * EDITAR PRODUCTO
    ========================*/

    public $idProducto;

    public function ajaxEditarProduto() {
        $item = "id";
        $valor = $this->idProducto;

        $respuesta = ControllerProductos::ctrMostrarProductos($item, $valor);

        echo json_encode($respuesta);
    }

    public $idProductoElinar;

    public function ajaxEliminarProduto() {
        $item = "id";
        $valor = $this->idProductoEliminar;

        $respuesta = ControllerProductos::ctrEliminarProducto($item, $valor);

        echo json_encode($respuesta);
    }
}

/**======================
* EDITAR PRODUCTO
========================*/
if (isset($_POST['idProducto'])) {
    $editarProducto = new AjaxProductos();
    $editarProducto->idProducto = $_POST['idProducto'];
    $editarProducto->ajaxEditarProduto();   
}

/**======================
* ELiminar PRODUCTO
========================*/
if (isset($_POST['idEliminarProducto'])) {
    $eliminarProducto = new AjaxProductos();
    $eliminarProducto->idProductoEliminar = $_POST['idEliminarProducto'];
    $eliminarProducto->ajaxEliminarProduto();   
}