<?php

require_once "conexion.php";

class ModelUsuarios
{
    static public function mdlMostrarUsuarios($tabla, $item, $valor) {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt -> execute();
            return $stmt->fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt -> execute();
            return $stmt->fetchAll();
        
        }

        $stmt = null;

    }

    static public function mdlCrearUsuario($tabla, $datos) {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, username, password, tipo, foto) VALUES(:nombre, :username, :password, :tipo, :foto);");
        $stmt -> bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
        $stmt -> bindParam(":username", $datos['username'], PDO::PARAM_STR);
        $stmt -> bindParam(":password", $datos['password'], PDO::PARAM_STR);
        $stmt -> bindParam(":tipo", $datos['tipo'], PDO::PARAM_STR);
        $stmt -> bindParam(":foto", $datos['foto'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    static public function mdlEditarUsuario($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre=:nombre, password=:password, 
                                            tipo=:tipo, foto=:foto WHERE username=:username");

        $stmt -> bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
        $stmt -> bindParam(":username", $datos['username'], PDO::PARAM_STR);
        $stmt -> bindParam(":password", $datos['password'], PDO::PARAM_STR);
        $stmt -> bindParam(":tipo", $datos['tipo'], PDO::PARAM_STR);
        $stmt -> bindParam(":foto", $datos['foto'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
        
        $stmt = null;
    }

    /**
     * ACTUALIZAR USUARIO
     */

     static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2)
     {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

        $stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
        $stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
        
        $stmt = null;

     }
}