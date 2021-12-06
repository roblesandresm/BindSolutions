<?php 

require_once "conexion.php";

class ModelProductos {

    /**
     * MOSTRAR PRODUCTO
     */
    static public function mdlMostrarProductos($tabla, $item, $valor) {

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
     * CREAR PRODUCTO
     */
    static public function mdlCrearProducto($tabla, $datos) {
        
        $sql = "INSERT INTO $tabla(nombre, foto, precio_compra, precio_venta) VALUES (?, ?, ?, ?)";
        $stmt = Conexion::conectar()->prepare($sql)->execute([$datos['nombre'], $datos['foto'], $datos['precio_compra'], $datos['precio_venta'] ]);

        if ($stmt) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    /**
     * EDITAR PRODUCTO
     */
    static public function mdlEditarProducto($tabla, $datos) {
        
        $sql = "UPDATE $tabla SET nombre=?, foto=?, precio_compra=?, precio_venta=? WHERE id=?";
        $stmt = Conexion::conectar()->prepare($sql)->execute([$datos['nombre'], $datos['foto'], $datos['precio_compra'], $datos['precio_venta'], $datos['id'] ]);

        if ($stmt) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    /**
     * ELIMINAR PRODUCTO
     */
    static public function mdlEliminarProducto($tabla, $item, $valor) {
        
        $sql = "UPDATE $tabla SET estado=0 WHERE $item=?";
        $stmt = Conexion::conectar()->prepare($sql)->execute([ $valor ]);

        if ($stmt) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt->closeCursor();
        $stmt = null;
    }
}