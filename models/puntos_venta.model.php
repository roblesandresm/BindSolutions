<?php

class ModelPuntosVenta
{
    /**
     * MOSTRAR Eventos
     */
    static public function mdlMostrarPuntosVenta($tabla, $item, $valor) {

        if ($item != null) {

            $sql = "SELECT pv.id, pv.nombre, ev.nombre as evento, vd.nombre as vendedor, pv.estado 
            FROM $tabla pv 
            INNER JOIN eventos ev ON pv.id_evento = ev.id 
            INNER JOIN usuarios vd ON pv.id_vendedor = vd.id
            $item=?;";
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
}