<?php
namespace Modelo\BD;



use Modelo\Base\Administracion;
use Modelo\Base\Gerencia;
use Modelo\Base\Logistica;
use Modelo\Base\Produccion;
use Modelo\BD;
use Modelo\Base;
require_once __DIR__."/GenericoBD.php";


abstract class TrabajadorBD extends GenericoBD{

    private static $tabla = "trabajadores";

    public static function getTrabajadoresByCentro($centro){

        $con = parent::conectar();

        $query = "SELECT * FROM ".self::$tabla." WHERE idCentro = ".$centro->getId();

        $rs = mysqli_query($con, $query) or die("Error getTrabajadoresByCentro");

        $trabajadores = parent::mapear($rs, "Trabajador");

        parent::desconectar($con);

        return $trabajadores;

    }

    public static function getTrabajadorByLogin($login){
        $conexion = parent::conectar();
        $query = "SELECT * FROM trabajadores WHERE dni = ".$login->getUsuario() ." ";
        $rs = mysqli_query($conexion, $query) or die(mysqli_error($conexion));
        $trabajador = parent::mapear($rs, "Trabajador");
        parent::desconectar($conexion);
        return $trabajador;
    }

    public static function getTrabajadorByHorariosTrabajadores($horarioTrabajador){

        $conexion = parent::conectar();


        $query="SELECT t.dni,t.nombre,t.apellido1,t.apellido2,t.telefono,t.foto,t.idCentro,p.tipo FROM ".self::$tabla." t,perfiles p where t.idPerfil=p.id and dni= (select dniTrabajador from horariotrabajadores where id=".$horarioTrabajador->getId().") ORDER BY apellido1, apellido2";
        $rs = mysqli_query($conexion, $query) or die(mysqli_error($conexion));
        $trabajador = parent::mapear($rs, null);
        parent::desconectar($conexion);
        return $trabajador;

    }
    public static function getTrabajadorByParte($partelogistica){
        $conexion=  parent::conectar();

        $query= "SELECT * FROM trabajadores WHERE dni=(SELECT dniTrabajador FROM parteslogistica WHERE id=".$partelogistica->getId()." )";
        $rs= mysqli_query($conexion,$query) or die(mysqli_error($conexion));

            $trabajador = parent::mapear($rs,"Trabajador");


        parent::desconectar($conexion);

        return $trabajador;

    }

    public static function getTrabajadorByDni($dni){
        $conexion = parent::conectar();

        $queryPerfil = "SELECT tipo FROM perfiles WHERE id = (SELECT idPerfil FROM trabajadores WHERE dni = '".$dni."')";
        $rsPerfil = mysqli_query($conexion, $queryPerfil) or die(mysqli_error($conexion));
        $fila = mysqli_fetch_array($rsPerfil);
        $perfil = $fila['tipo'];

        $query = "SELECT * FROM trabajadores WHERE dni = '".$dni."'";
        $rs = mysqli_query($conexion, $query) or die(mysqli_error($conexion));

        $trabajador = parent::mapear($rs, $perfil);

        parent::desconectar($conexion);

        return $trabajador;

    }

    public static function getTrabajador($dni){
        $conexion=parent::conectar();

        $query= "SELECT * FROM trabajadores WHERE dni = '.$dni.'";
        $rs= mysqli_query($conexion,$query) or die(mysqli_error($conexion));

        $trabajador= parent::mapear($rs,"Trabajador");
        parent::desconectar($conexion);
        return $trabajador;
    }

    public static function add($trabajador){

        $con = parent::conectar();

        //SACAR PERFIL ID///
        $perfil = get_class($trabajador);
        $perfil = substr(strrchr($perfil, "\\"), 1);
        $queryPerfil = "SELECT id FROM perfiles WHERE tipo = '" . $perfil."'";
        $rs = mysqli_query($con, $queryPerfil) or die("ErrorqueryPerfil");
        $fila = mysqli_fetch_array($rs);
        $idPerfil = $fila['id'];
        //////////

        $query = "INSERT INTO ".self::$tabla." VALUES('".$trabajador->getDni()."','".$trabajador->getNombre()."','".$trabajador->getApellido1()."','".$trabajador->getApellido2()."','".$trabajador->getTelefono()."',".$trabajador->getCentro()->getId().",".$idPerfil.",'".$trabajador->getFoto()."')"; //NOTA no hay objeto Perfil usamos getClass?? ----> esto no se puede: $trabajador->getPerfil()->getId()
        mysqli_query($con, $query) or die("Error addTrabajador");

        parent::desconectar($con);

    }

    public function getTareasParteByFecha(){

        $diaSemana = date("N");
        $fechaSemana = date("d/m/Y",strtotime("-$diaSemana day"));

        if(is_null($this->tareasParte)){
            $this->tareasParte = ParteProduccionTareaBD::getTareasByParteAndFecha($this,$fechaSemana);
        }

        return $this->tareasParte;
    }

    public static function deleteTrabajador($dni)
    {

        $con = parent::conectar();

        $query = "DELETE FROM " . self::$tabla . " WHERE dni='".$dni."'";

        mysqli_query($con, $query) or die(mysqli_error($con));

        parent::desconectar($con);
    }

    public static function getAllPerfiles(){

        $con = parent::conectar();

        $query = "SELECT id,tipo FROM perfiles ORDER BY tipo";

        $rs = mysqli_query($con, $query) or die("Error getAllPerfiles");

        $perfil = array();
        while($fila = mysqli_fetch_assoc($rs)){
            $perfil[] = array($fila['id'],$fila['tipo']);
        }

        parent::desconectar($con);

        return $perfil;

    }

    public static function getAllTrabajadores(){

        $con = parent::conectar();

        $query = "SELECT t.dni,t.nombre,t.apellido1,t.apellido2,t.telefono,t.foto,t.idCentro,p.tipo FROM ".self::$tabla." t,perfiles p where t.idPerfil=p.id ORDER BY apellido1, apellido2";

        $rs = mysqli_query($con, $query) or die("Error getAllTipoTrabajadores");

        $trabajadores = parent::mapearArray($rs,null);

        parent::desconectar($con);

        return $trabajadores;

    }

    public static function obtenerPerfil($id){
        $con = parent::conectar();
        $queryPerfil = "SELECT tipo FROM perfiles WHERE id = ".$id;
        $rsPerfil = mysqli_query($con, $queryPerfil) or die("error queryPerfilAllTrabajadores");
        $filaPerfil = mysqli_fetch_array($rsPerfil);
        parent::desconectar($con);
        return $filaPerfil["tipo"];
    }

    public static function updateFotoByTrabajador($trabajador){

        $con = parent::conectar();

        $query = "UPDATE ".self::$tabla." SET foto = '".$trabajador->getFoto()."' WHERE DNI = '".$trabajador->getDni()."'";

        mysqli_query($con, $query) or die("error updateFoto");

        parent::desconectar($con);

    }

    public static function getPerfilByDni($trabajador){
        $conexion = parent::conectar();

        $query = "SELECT tipo FROM perfiles WHERE id = (SELECT idPerfil FROM trabajadores WHERE dni = '".$trabajador->getDni()."')";

        $rs = mysqli_query($conexion, $query) or die("error getPerfilDni");

        $perfil = mysqli_fetch_array($rs);

        parent::desconectar($conexion);

        return $perfil['tipo'];

    }
}