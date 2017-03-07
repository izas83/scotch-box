<?php
namespace Modelo\BD;
/**
 * Created by PhpStorm.
 * User: Jon
 * Date: 28/02/2016
 * Time: 20:03
 */
require_once __DIR__."/GenericoBD.php";
abstract class ParteProduccionTareaBD extends GenericoBD
{

    private static $tabla = "partesproducciontareas";

    public static function getAllByParte($parte){

        $conexion = GenericoBD::conectar();

        $select = "SELECT * FROM ".self::$tabla." WHERE idParteProduccion = ".$parte->getId();

        $resultado = mysqli_query($conexion,$select);

        $partes = GenericoBD::mapearArray($resultado,"ParteProduccionTarea");


        GenericoBD::desconectar($conexion);

        return $partes;

    }

    public static function getAllById($id){

        $conexion = GenericoBD::conectar();

        $query = "SELECT * FROM ".self::$tabla." WHERE id = ".$id;

        $rs = mysqli_query($conexion,$query) or die(mysqli_error($conexion));

        $parte = GenericoBD::mapear($rs,"ParteProduccionTarea");


        GenericoBD::desconectar($conexion);

        return $parte;

    }

    public static function save($ParteProduccionTarea){

        $conexion = parent::conectar();

        $insert = "INSERT INTO ".self::$tabla." (idTareas,idParteProduccion,numeroHoras,paqueteEntrada,paqueteSalida) VALUES (".$ParteProduccionTarea->getTarea()->getId().",".$ParteProduccionTarea->getParte()->getId().",'".$ParteProduccionTarea->getNumeroHoras()."','".$ParteProduccionTarea->getPaqueteEntrada()."'".",'".$ParteProduccionTarea->getPaqueteSalida()."');";

        $res = mysqli_query($conexion,$insert) or die("Error InsertParteProduccionTarea -".mysqli_error($conexion));

        if($res){
            parent::desconectar($conexion);
            return "Tarea insertada correctamente.";

        }

        parent::desconectar($conexion);
    }

    public static function update($ParteProduccionTarea){

        $conexion = GenericoBD::conectar();

        $update = "UPDATE ".self::$tabla." SET numeroHoras='".$ParteProduccionTarea->getNumeroHoras()."', paqueteEntrada='".$ParteProduccionTarea->getPaqueteEntrada()."', paqueteSalida='".$ParteProduccionTarea->getPaqueteSalida()."', idParteProduccion='".$ParteProduccionTarea->getParte()->getId()."', idTareas='".$ParteProduccionTarea->getTarea()->getId()."' WHERE id = '".$ParteProduccionTarea->getId()."';";
        mysqli_query($conexion,$update) or die("Error UpdateParteProduccionTarea");

        GenericoBD::desconectar($conexion);
        return "ok";
    }


    public static function modificar($parteProduccionTarea){
        $conexion= parent::conectar();
        $query= "UPDATE partesproducciontareas SET numeroHoras='".$parteProduccionTarea->getNumeroHoras()."', paqueteEntrada='".$parteProduccionTarea->getPaqueteEntrada()."', paqueteSalida='".$parteProduccionTarea->getPaqueteSalida()."', idTareas='".$parteProduccionTarea->getTarea()->getId()."' WHERE id= '".$parteProduccionTarea->getId()."';";
        $respuesta= mysqli_query($conexion,$query) or die(mysqli_error($conexion));

        if($respuesta){
            parent::desconectar($conexion);
            return "Parte modificado correctamente";

        }
        parent::desconectar($conexion);

    }


    public static function delete($ParteProduccionTarea){
        $conexion = GenericoBD::conectar();

        $delete = "DELETE FROM ".self::$tabla." WHERE id = '".$ParteProduccionTarea->getId()."';";

        mysqli_query($conexion,$delete) or die("Error DeleteParteProduccionTarea");

        GenericoBD::desconectar($conexion);
    }


}