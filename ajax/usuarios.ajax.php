<?php

require_once "../controllers/usuarios.controller.php";
require_once "../models/usuarios.model.php";

class AjaxUsuarios
{
    /*====================
     *  EDITAR USUARIO   =
    ====================*/
    public $idUsuario;

    public function ajaxEditarUsuario()
    {
        $item = 'id';
        $valor = $this->idUsuario;
        $respuesta = ControllerUsuarios::ctrMostrarUsuario($item, $valor);

        echo json_encode($respuesta);
    }

    /*====================
     *  ACTIVAR USUARIO   =
    ====================*/
    public $activarId;
    public $activarUsuario;

    public function ajaxActivarUsuario()
    {
        $tabla = "usuarios";

        $item1 = "estado";
        $valor1 = $this->activarUsuario;
        $item2 = "id";
        $valor2 = $this->activarId;

        $respuesta = ModelUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
    }

    /*======================================================
     *  VALIDAR NO REPETIR USUARIO AL CREAR NUEVO USUARIO  =
    =======================================================*/

    public $validarUsuario;

    public function ajaxValidarUsuario() {

        $item = 'username';
        $valor = $this->validarUsuario;
        $respuesta = ControllerUsuarios::ctrMostrarUsuario($item, $valor);

        echo json_encode($respuesta);
    }
    
}

/*====================
*  EDITAR USUARIO   =
* ====================*/

if (isset($_POST['idUsuario'])) {
    $editar = new AjaxUsuarios();
    $editar->idUsuario = $_POST['idUsuario'];
    $editar->ajaxEditarUsuario();
}

/*====================
*  ACTIVAR USUARIO   =
====================*/
if (isset($_POST['activarUsuario'])) {

    $activarUsuario = new AjaxUsuarios();
    $activarUsuario->activarUsuario = $_POST['activarUsuario'];
    $activarUsuario->activarId = $_POST['activarId'];
    $editar->ajaxActivarUsuario();

}

/*===============================
*  VALIDAR NO REPETIR USUARIO   =
*===============================*/
if (isset($_POST['validarUsuario'])) {

    $valUsuario = new AjaxUsuarios();
    $valUsuario->validarUsuario = $_POST['validarUsuario'];
    $valUsuario->ajaxValidarUsuario();

}

