<?php

require_once "../controllers/eventos.controller.php";
require_once "../models/eventos.model.php";

class AjaxEventos {

    /**======================
    * EDITAR EVENTO
    ========================*/

    public $idEvento;

    public function ajaxEditarEvento() {
        $item = "id";
        $valor = $this->idEvento;

        $respuesta = ControllerEventos::ctrMostrarEventos($item, $valor);

        echo json_encode($respuesta);
    }

    /*====================
     *  TERMINAR EVENTO  =
    ====================*/
    public $idEventoTerminar;

    public function ajaxTerminarEvento()
    {
        $tabla = "eventos";
        $item = "id";
        $id = $this->idEventoTerminar;

        $respuesta = ModelEventos::mdlTerminarEvento($tabla, $item, $id);
    }

    /*====================
     *  ELIMINAR EVENTO  =
    ====================*/
    public $idEliminarEvento;

    public function ajaxEliminarEvento()
    {
        $tabla = "eventos";
        $item = "id";
        $id = $this->idEliminarEvento;

        $respuesta = ModelEventos::mdlEliminarEvento($tabla, $item, $id);
    }
}

/**======================
* EDITAR EVENTO
========================*/
if (isset($_POST['idEvento'])) {
    $editarEvento = new AjaxEventos();
    $editarEvento->idEvento = $_POST['idEvento'];
    $editarEvento->ajaxEditarEvento();    
}

/**======================
* TERMINAR EVENTO
========================*/
if (isset($_POST['idEventoTerminar'])) {
    $terminarEvento = new AjaxEventos();
    $terminarEvento->idEventoTerminar = $_POST['idEventoTerminar'];
    $terminarEvento->ajaxTerminarEvento();    
}

/*====================
*  ELIMINAR EVENTO  =
====================*/
if (isset($_POST['idEliminarEvento'])) {
    $eliminarEvento = new AjaxEventos();
    $eliminarEvento->idEliminarEvento = $_POST['idEliminarEvento'];
    $eliminarEvento->ajaxEliminarEvento();    
}