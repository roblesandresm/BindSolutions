<?php

require_once "conexion.php";

class ModelPuntosVenta
{
    /**
     * MOSTRAR Eventos
     */
    static public function mdlMostrarPuntosVenta($tabla, $item, $valor) {

        if ($item != null) {

            $sql = "SELECT * FROM $tabla WHERE $item=?;";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt -> execute([$valor]);
            return $stmt->fetch();
            $stmt = null;

        } else {

            $sql = "SELECT pv.id, pv.nombre, ev.nombre as evento, vd.nombre as vendedor, pv.estado 
            FROM $tabla pv 
            INNER JOIN eventos ev ON pv.id_evento = ev.id 
            INNER JOIN usuarios vd ON pv.id_vendedor = vd.id;";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt -> execute();
            return $stmt->fetchAll();
            $stmt = null;
        
        }

    }

    /**
     * CREAR PUNTO VENTAS
     */
    static public function mdlCrearPuntoVenta($tabla, $datos) {
        $sql = "INSERT INTO $tabla(nombre, id_evento, id_vendedor) VALUES (?, ?, ?)";
        $stmt = Conexion::conectar()->prepare($sql)->execute([$datos['nombre'], $datos['evento'], $datos['vendedor'] ]);

        if ($stmt) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    /**
     * EDITAR PUNTO DE VENTA
     */
    static public function mdlEditarPuntoVenta($tabla, $datos) {
        $sql = "UPDATE $tabla SET nombre=?, id_evento=?, id_vendedor=? WHERE id=?;";
        $stmt = Conexion::conectar()->prepare($sql)->execute([$datos['nombre'], $datos['id_evento'], $datos['id_vendedor'], $datos['id'] ]);

        if ($stmt) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    /**
     * ACTIVAR O DESACTIVAR PUNTO DE VENTA
     */
    static public function mdlCambiarEstadoPV($tabla, $item1, $valor1, $item2, $valor2) {

        $sql = "UPDATE $tabla SET $item1=? WHERE $item2=?;";
        $stmt = Conexion::conectar()->prepare($sql)->execute([$valor1,$valor2]);

        if ($stmt) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    /**
     * ELIMINAR PUNTO DE VENTA
     */
    static public function mdlEliminarPuntoVenta($tabla, $item, $id) {
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