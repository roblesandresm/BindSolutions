<?php

class ModelEventos
{
    /**
     * MOSTRAR Eventos
     */
    static public function mdlMostrarEventos($tabla, $item, $valor) {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt -> execute();
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
}