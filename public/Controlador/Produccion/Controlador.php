<?php
namespace Controlador\Produccion;

use Modelo\Base;
use Modelo\BD;


require_once __DIR__."/../../Modelo/BD/TipoTareaBD.php";
require_once __DIR__."/../../Modelo/BD/TareaBD.php";
require_once __DIR__."/../../Modelo/BD/ParteProduccionBD.php";
require_once __DIR__."/../../Modelo/BD/ParteProducionTareaBD.php";
require_once __DIR__."/../../Modelo/Base/ParteProducionTareaClass.php";
require_once __DIR__."/../../Modelo/Base/HorariosClass.php";
require_once __DIR__."/../../Modelo/Base/TareaClass.php";
require_once __DIR__."/../../Modelo/Base/TipoTareaClass.php";
require_once __DIR__."/../../Modelo/Base/ProduccionClass.php";
require_once __DIR__."/../../Modelo/Base/EstadoClass.php";

/**
 * Created by PhpStorm.
 * User: Mikel
 * Date: 2/3/16
 * Time: 19:17
 */
class Controlador
{
    public static function getTareasSelect()
    {

        return BD\TipoTareaBD::getAll();

    }

    public static function getTareas()
    {
        return BD\TareaBD::getTareas();
    }

    public static function getAllById($datos)
    {

        return BD\ParteProduccionTareaBD::getAllById($datos);
    }

    public static function getHorario($datos){
        return BD\HorarioBD::getHorarioByHorarioTrabajador($datos);
    }

    public static function getParteById($datos){
        return BD\ParteProduccionBD::getParteById($datos);
    }


}

?>