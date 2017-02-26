<?php
/**
 * Created by PhpStorm.
 * User: 2gdwes10
 * Date: 29/2/16
 * Time: 11:13
 */
namespace Modelo\Base;
use Modelo\BD;

require_once __DIR__."/../BD/HorasConvenioBD.php";
require_once __DIR__."/HoraConvenioClass.php";
require_once __DIR__."/TrabajadorClass.php";
class Administracion extends Trabajador{



    private $horasConvenio;

    /**
     * Administracion constructor.
     * @param $parteLogistica
     */
    public function __construct($dni = null, $nombre = null, $apellido1 = null, $apellido2 = null, $telefono = null, $foto = null, $centro = null,  $trabajadorAusencias = null, $horariosTrabajador = null,$horasConvenio=null)
    {
        parent::__construct($dni , $nombre , $apellido1 , $apellido2 , $telefono , $foto , $centro ,  $trabajadorAusencias , $horariosTrabajador );

        $this->setHorasConvenio($horasConvenio);
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