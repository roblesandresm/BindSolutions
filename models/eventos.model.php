<?php

require_once "conexion.php";

class ModelEventos
{
    /**
     * MOSTRAR Eventos
     */
    static public function mdlMostrarEventos($tabla, $item, $valor) {

        if ($item != null) {

            $sql = "SELECT * FROM $tabla WHERE $item=?";
            $stmt = Conexion::conectar()->prepare($sql);
            /* $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR); */
            $stmt -> execute([$valor]);
            return $stmt->fetch();
            $stmt = null;
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt -> execute();
            return $stmt->fetchAll();
            $stmt = null;
        }

    }

    /**
     * CREAR Evento
     */
    static public function mdlCrearEvento($tabla, $datos) {
        $sql = "INSERT INTO $tabla(nombre, id_socio, ubicacion) VALUES (?, ?, ?)";
        $stmt = Conexion::conectar()->prepare($sql)->execute([$datos['nombre'], $datos['id_socio'], $datos['ubicacion'] ]);

        if ($stmt) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    
    /**
     * EDITAR Evento
     */
    static public function mdlEditarEvento($tabla, $datos) {
        $sql = "UPDATE $tabla SET nombre=?, id_socio=?, ubicacion=? WHERE id=?;";
        $stmt = Conexion::conectar()->prepare($sql)->execute([$datos['nombre'], $datos['id_socio'], $datos['ubicacion'], $datos['id'] ]);

        if ($stmt) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    /**
     * TERMINAR Evento
     */
    static public function mdlTerminarEvento($tabla, $item, $id) {
        $sql = "UPDATE $tabla SET estado=2 WHERE $item=?;";
        $stmt = Conexion::conectar()->prepare($sql)->execute([$id]);

        if ($stmt) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    /**
     * Eliminar Evento
     */
    static public function mdlEliminarEvento($tabla, $item, $id) {
        $sql = "UPDATE $tabla SET estado=0 WHERE $item=?;";
        $stmt = Conexion::conectar()->prepare($sql)->execute([$id]);

        if ($stmt) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt->closeCursor();
        $stmt = null;
    }
}