<?php
/**
 * Created by PhpStorm.
 * User: 2gdwes10
 * Date: 29/2/16
 * Time: 10:38
 */
namespace Modelo\Base;
use Modelo\BD;

require_once __DIR__."/TrabajadorClass.php";
require_once __DIR__."/ParteLogisticaClass.php";
require_once __DIR__."/HoraConvenioClass.php";
require_once __DIR__."/../BD/PartesLogisticaBD.php";
require_once __DIR__."/../BD/HorasConvenioBD.php";




class Logistica extends Trabajador{

    private $parteLogistica;
    private $horasConvenio;

    /**
     * Logistica constructor.
     * @param $parteLogistica
     */
    public function __construct($dni = null, $nombre = null, $apellido1 = null, $apellido2 = null, $telefono = null, $foto = null, $centro = null,  $trabajadorAusencias = null, $horariosTrabajador = null,$parteLogistica=null,$horasConvenio=null)
    {
        parent::__construct($dni, $nombre, $apellido1, $apellido2, $telefono, $foto, $centro,  $trabajadorAusencias, $horariosTrabajador);
        $this->setParteLogistica($parteLogistica);
        $this->setHorasConvenio($horasConvenio);

    }


    /**
     * @return mixed
     */
    public function getParteLogistica()
    {
        if($this->parteLogistica==null){
            $this->setParteLogistica(BD\PartelogisticaBD::getAllByTrabajador($this));
        }
        return $this->parteLogistica;
    }

    /**
     * @param mixed $parteLogistica
     */
    public function setParteLogistica($parteLogistica)
    {
        $this->parteLogistica = $parteLogistica;
    }

    /**
     * @return mixed
     */
    public function getHorasConvenio()
    {
        if($this->horasConvenio==null){
            $this->setHorasConvenio(BD\HorasConvenioBD::getHorasConvenioByPerfil($this));
        }
        return $this->horasConvenio;
    }

    /**
     * @param mixed $horasConvenio
     */
    public function setHorasConvenio($horasConvenio)
    {
        $this->horasConvenio = $horasConvenio;
    }






}