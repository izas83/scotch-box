<?php
//GETTERS SIN TOCAR

namespace Modelo\Base;

use Modelo\BD;

require_once __DIR__."/CentroClass.php";
require_once __DIR__."/TrabajadorAusenciaClass.php";
require_once __DIR__."/HorariosTrabajadoresClass.php";
require_once __DIR__."/../BD/TrabajadorBD.php";
require_once __DIR__."/../BD/CentroBD.php";
require_once __DIR__."/../BD/TrabajadorAusenciaBD.php";
require_once __DIR__."/../BD/HorarioTrabajadorBD.php";




class Trabajador{

    private $dni;
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $telefono;
    private $foto;
    private $centro; //objeto centro (no he codificado nada BD)
    private $trabajadorAusencias; // array ausencias --tabla intermedia
    private $horariosTrabajador; // array Horarios(puede tener mñana, tarde y noche) --tabla intermedia

    public function __construct($dni = null, $nombre = null, $apellido1 = null, $apellido2 = null, $telefono = null,$foto = null , $centro = null,  $trabajadorAusencias = null, $horariosTrabajador = null)
    {
        $this->setDni($dni);
        $this->setNombre($nombre);
        $this->setApellido1($apellido1);
        $this->setApellido2($apellido2);
        $this->setTelefono($telefono);
        $this->setFoto($foto);
        $this->setCentro($centro);

        $this->setTrabajadorAusencias($trabajadorAusencias);
        $this->setHorariosTrabajador($horariosTrabajador);
    }

    /**
     * @return mixed
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * @param mixed $dni
     */
    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getApellido1()
    {
        return $this->apellido1;
    }

    /**
     * @param mixed $apellido1
     */
    public function setApellido1($apellido1)
    {
        $this->apellido1 = $apellido1;
    }

    /**
     * @return mixed
     */
    public function getApellido2()
    {
        return $this->apellido2;
    }

    /**
     * @param mixed $apellido2
     */
    public function setApellido2($apellido2)
    {
        $this->apellido2 = $apellido2;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param mixed $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * @return mixed
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @param mixed $foto
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    /**
     * @return mixed
     */
    public function getCentro()
    {
        if(is_null($this->centro)){
            $this->setCentro(BD\CentroBD::getCentroByTrabajador($this));
        }
        return $this->centro;
    }

    /**
     * @param mixed $centro
     */
    public function setCentro($centro)
    {
        $this->centro = $centro;
    }

    /**
     * @return mixed
     */
    public function getTrabajadorAusencias()
    {
        return $this->trabajadorAusencias;
    }

    /**
     * @param mixed $trabajadorAusencias
     */
    public function setTrabajadorAusencias($trabajadorAusencias)
    {
        $this->trabajadorAusencias = $trabajadorAusencias;
    }

    /**
     * @return mixed
     */
    public function getHorariosTrabajador()
    {
        if(is_null($this->horariosTrabajador)){
            $this->setHorariosTrabajador(BD\HorarioTrabajadorBD::getHorarioTrabajadorByTrabajador($this));
        }
        return $this->horariosTrabajador;
    }

    public function getHorariosTrabajadorBySemana($semana)
    {
        if(is_null($this->horariosTrabajador)){
            $this->setHorariosTrabajador(BD\HorarioTrabajadorBD::getHorarioTrabajadorByTrabajadorBySemana($this,$semana));
        }
        return $this->horariosTrabajador;
    }

    /**
     * @param mixed $horariosTrabajador
     */
    public function setHorariosTrabajador($horariosTrabajador)
    {
        $this->horariosTrabajador = $horariosTrabajador;
    }

    public function add(){
        BD\TrabajadorBD::add($this);
    }

}