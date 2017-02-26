<?php
/**
 * Created by PhpStorm.
 * User: 2gdwes10
 * Date: 1/3/16
 * Time: 10:33
 */

namespace Modelo\Base;

use Modelo\BD;

require_once __DIR__."/../BD/FestivoBD.php";

class Festivo
{

    private $id;
    private $fecha;
    private $motivo;

    /**
     * Festivo constructor.
     * @param $id
     * @param $fecha
     * @param $motivo
     */
    public function __construct($id = null, $fecha = null, $motivo = null)
    {
        $this->setId($id);
        $this->setFecha($fecha);
        $this->setMotivo($motivo);
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @return mixed
     */
    public function getMotivo()
    {
        return $this->motivo;
    }

    /**
     * @param mixed $motivo
     */
    public function setMotivo($motivo)
    {
        $this->motivo = $motivo;
    }

    public static function getAll()
    {
        return BD\FestivoBD::getAll();
    }

}