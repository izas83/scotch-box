<?php
namespace Vista\Logistica;
use Controlador\Administracion\Controlador;
use Vista\Plantilla;
use Controlador\Logistica;
use Modelo\Base;

    require_once __DIR__."/../Plantilla/Views.php";
    require_once __DIR__."/../../Controlador/Logistica/Controlador.php";

    $trabajador=unserialize($_SESSION['trabajador']);

    $vehiculos = Logistica\Controlador::ArrayVehiculosByCentro($trabajador->getCentro());


    if(isset($_POST["cod"])){
        switch($_POST["cod"]) {
            case 1:
                $hoy = date("d-m-Y");

                if ($_POST["fecha"] <= $hoy) {

                    ?>


                    <form action="">
                        <input id="fecha" type="hidden" name="fecha" value="<?php echo $_POST['fecha'] ?>">
                        <div class="form-group">
                            <label for="Vehiculo" class="col-sm-3 control-label">Vehiculo: </label>
                            <div class="col-sm-9">
                                <select id="Vehiculo" name="Vehiculo" data-validetta="required" class="form-control">
                                    <option value="">Elija</option>
                                    <?php

                                    foreach ($vehiculos as $vehiculo) {
                                        ?>
                                        <option name="<?php echo $vehiculo->getMatricula() ?>"
                                                value="<?php echo $vehiculo->getId() ?>"><?php echo $vehiculo->getMatricula() ?></option>

                                        <?php
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="horaInicio" class="col-sm-3 control-label">Hora de inicio: </label>
                            <div class="col-sm-4 container">
                                <?php $now = new \DateTime();
                                $ahora = $now->format("H");

                                ?>
                                <select id="HorasInicio" data-validetta="required" class="form-control">
                                    <option<?php if ($ahora == "00") {
                                        echo " selected";
                                    } ?> name="00" value="00">00
                                    </option>
                                    <option<?php if ($ahora == "01") {
                                        echo " selected";
                                    } ?> name="00" value="01">01
                                    </option>
                                    <option<?php if ($ahora == "02") {
                                        echo " selected";
                                    } ?> name="00" value="02">02
                                    </option>
                                    <option<?php if ($ahora == "03") {
                                        echo " selected";
                                    } ?> name="00" value="03">03
                                    </option>
                                    <option<?php if ($ahora == "04") {
                                        echo " selected";
                                    } ?> name="00" value="04">04
                                    </option>
                                    <option<?php if ($ahora == "05") {
                                        echo " selected";
                                    } ?> name="00" value="05">05
                                    </option>
                                    <option<?php if ($ahora == "06") {
                                        echo " selected";
                                    } ?> name="00" value="06">06
                                    </option>
                                    <option<?php if ($ahora == "07") {
                                        echo " selected";
                                    } ?> name="00" value="07">07
                                    </option>
                                    <option<?php if ($ahora == "08") {
                                        echo " selected";
                                    } ?> name="00" value="08">08
                                    </option>
                                    <option<?php if ($ahora == "09") {
                                        echo " selected";
                                    } ?> name="00" value="09">09
                                    </option>
                                    <option<?php if ($ahora == "10") {
                                        echo " selected";
                                    } ?> name="00" value="10">10
                                    </option>
                                    <option<?php if ($ahora == "11") {
                                        echo " selected";
                                    } ?> name="00" value="11">11
                                    </option>
                                    <option<?php if ($ahora == "12") {
                                        echo " selected";
                                    } ?> name="00" value="12">12
                                    </option>
                                    <option<?php if ($ahora == "13") {
                                        echo " selected";
                                    } ?> name="00" value="13">13
                                    </option>
                                    <option<?php if ($ahora == "14") {
                                        echo " selected";
                                    } ?> name="00" value="14">14
                                    </option>
                                    <option<?php if ($ahora == "15") {
                                        echo " selected";
                                    } ?> name="00" value="15">15
                                    </option>
                                    <option<?php if ($ahora == "16") {
                                        echo " selected";
                                    } ?> name="00" value="16">16
                                    </option>
                                    <option<?php if ($ahora == "17") {
                                        echo " selected";
                                    } ?> name="00" value="17">17
                                    </option>
                                    <option<?php if ($ahora == "18") {
                                        echo " selected";
                                    } ?> name="00" value="18">18
                                    </option>
                                    <option<?php if ($ahora == "19") {
                                        echo " selected";
                                    } ?> name="00" value="19">19
                                    </option>
                                    <option<?php if ($ahora == "20") {
                                        echo " selected";
                                    } ?> name="00" value="20">20
                                    </option>
                                    <option<?php if ($ahora == "21") {
                                        echo " selected";
                                    } ?> name="00" value="21">21
                                    </option>
                                    <option<?php if ($ahora == "22") {
                                        echo " selected";
                                    } ?> name="00" value="22">22
                                    </option>
                                    <option<?php if ($ahora == "23") {
                                        echo " selected";
                                    } ?> name="00" value="23">23
                                    </option>
                                </select>
                            </div>
                            <span class="col-sm-1"><h4>:</h4></span>

                            <div class="col-sm-4 container">
                                <select id="MinutosInicio" data-validetta="required" class="form-control ">
                                    <option name="00" value="00">00</option>
                                    <option name="00" value="01">05</option>
                                    <option name="00" value="02">10</option>
                                    <option name="00" value="03">15</option>
                                    <option name="00" value="04">20</option>
                                    <option name="00" value="05">25</option>
                                    <option name="00" value="06">30</option>
                                    <option name="00" value="07">35</option>
                                    <option name="00" value="08">40</option>
                                    <option name="00" value="09">45</option>
                                    <option name="00" value="10">50</option>
                                    <option name="00" value="11">55</option>
                                </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="horaFin" class="col-sm-3 control-label">Hora de fin: </label>
                            <div class="col-sm-4 container">
                                <select id="HorasFin" data-validetta="required" class="form-control">
                                    <option<?php if ($ahora == "00") {
                                        echo " selected";
                                    } ?> name="00" value="00">00
                                    </option>
                                    <option<?php if ($ahora == "01") {
                                        echo " selected";
                                    } ?> name="00" value="01">01
                                    </option>
                                    <option<?php if ($ahora == "02") {
                                        echo " selected";
                                    } ?> name="00" value="02">02
                                    </option>
                                    <option<?php if ($ahora == "03") {
                                        echo " selected";
                                    } ?> name="00" value="03">03
                                    </option>
                                    <option<?php if ($ahora == "04") {
                                        echo " selected";
                                    } ?> name="00" value="04">04
                                    </option>
                                    <option<?php if ($ahora == "05") {
                                        echo " selected";
                                    } ?> name="00" value="05">05
                                    </option>
                                    <option<?php if ($ahora == "06") {
                                        echo " selected";
                                    } ?> name="00" value="06">06
                                    </option>
                                    <option<?php if ($ahora == "07") {
                                        echo " selected";
                                    } ?> name="00" value="07">07
                                    </option>
                                    <option<?php if ($ahora == "08") {
                                        echo " selected";
                                    } ?> name="00" value="08">08
                                    </option>
                                    <option<?php if ($ahora == "09") {
                                        echo " selected";
                                    } ?> name="00" value="09">09
                                    </option>
                                    <option<?php if ($ahora == "10") {
                                        echo " selected";
                                    } ?> name="00" value="10">10
                                    </option>
                                    <option<?php if ($ahora == "11") {
                                        echo " selected";
                                    } ?> name="00" value="11">11
                                    </option>
                                    <option<?php if ($ahora == "12") {
                                        echo " selected";
                                    } ?> name="00" value="12">12
                                    </option>
                                    <option<?php if ($ahora == "13") {
                                        echo " selected";
                                    } ?> name="00" value="13">13
                                    </option>
                                    <option<?php if ($ahora == "14") {
                                        echo " selected";
                                    } ?> name="00" value="14">14
                                    </option>
                                    <option<?php if ($ahora == "15") {
                                        echo " selected";
                                    } ?> name="00" value="15">15
                                    </option>
                                    <option<?php if ($ahora == "16") {
                                        echo " selected";
                                    } ?> name="00" value="16">16
                                    </option>
                                    <option<?php if ($ahora == "17") {
                                        echo " selected";
                                    } ?> name="00" value="17">17
                                    </option>
                                    <option<?php if ($ahora == "18") {
                                        echo " selected";
                                    } ?> name="00" value="18">18
                                    </option>
                                    <option<?php if ($ahora == "19") {
                                        echo " selected";
                                    } ?> name="00" value="19">19
                                    </option>
                                    <option<?php if ($ahora == "20") {
                                        echo " selected";
                                    } ?> name="00" value="20">20
                                    </option>
                                    <option<?php if ($ahora == "21") {
                                        echo " selected";
                                    } ?> name="00" value="21">21
                                    </option>
                                    <option<?php if ($ahora == "22") {
                                        echo " selected";
                                    } ?> name="00" value="22">22
                                    </option>
                                    <option<?php if ($ahora == "23") {
                                        echo " selected";
                                    } ?> name="00" value="23">23
                                    </option>
                                </select>
                            </div>
                            <span class="col-sm-1"><h4>:</h4></span>

                            <div class="col-sm-4 container">
                                <select id="MinutosFin" data-validetta="required" class="form-control ">
                                    <option name="00" value="00">00</option>
                                    <option name="00" value="01">05</option>
                                    <option name="00" value="02">10</option>
                                    <option name="00" value="03">15</option>
                                    <option name="00" value="04">20</option>
                                    <option name="00" value="05">25</option>
                                    <option name="00" value="06">30</option>
                                    <option name="00" value="07">35</option>
                                    <option name="00" value="08">40</option>
                                    <option name="00" value="09">45</option>
                                    <option name="00" value="10">50</option>
                                    <option name="00" value="11">55</option>
                                </select>

                            </div>
                        </div>


                        <div class="form-group">
                            <label for="NºAlbaran" class="col-sm-3 control-label">Nº Albaran: </label>
                            <div class="col-sm-9">
                                <input type="number" id="Albaran" class="form-control">

                            </div>
                        </div>


                        <div class="form-group" align="center">
                            <div class="col-sm-12 col-xs-offset-1">
                                <button type="button"  id="enviar" class="btn btn-primary enviar">Añadir</button>
                                <button type='button' id="salir" class='btn btn-warning salir'>Salir</button>
                            </div>

                        </div>
                    </form>


                    <?php

                } else {
                    echo false;
                }
                break;


    case 2:
                    $id= $_POST['id'];
                    $viaje= Logistica\Controlador::getViajeById($id);
                   echo $viaje->getHoraInicio();
                   echo $viaje->getHoraFin();

                    ?>
        <form action="">
                        <div class="form-group">
                            <input type="hidden" name="idViaje" id="idViaje" value="<?php echo $viaje->getId();?>">
                            <label for="Viaje" class="col-sm-3 control-label">Vehiculo: </label>
                            <div class="col-sm-9">
                                <select id="Vehiculo" data-validetta="required" class="form-control">
                                    <option value="<?php echo $viaje->getVehiculo()->getId(); ?>"><?php echo $viaje->getVehiculo()->getMatricula();?></option>
                                    <?php

                                    foreach ($vehiculos as $vehiculo) {
                                        ?>
                                        <option name="<?php echo $vehiculo->getMatricula() ?>"
                                                value="<?php echo $vehiculo->getId() ?>"><?php echo $vehiculo->getMatricula() ?></option>

                                        <?php
                                    }?>


                                </select>
                            </div>
                        </div>

                <br><br>
    <div class="form-group">
        <label for="horaInicio" class="col-sm-3 control-label">Hora de inicio: </label>
        <div class="col-sm-4 container">
            <?php $now = new \DateTime();
            $ahora = $now->format("H");

            ?>

            <select id="HorasInicio" data-validetta="required" class="form-control">

                <option<?php if ($ahora == "00") {
                    echo " selected";
                } ?> name="00" value="00">00
                </option>
                <option<?php if ($ahora == "01") {
                    echo " selected";
                } ?> name="00" value="01">01
                </option>
                <option<?php if ($ahora == "02") {
                    echo " selected";
                } ?> name="00" value="02">02
                </option>
                <option<?php if ($ahora == "03") {
                    echo " selected";
                } ?> name="00" value="03">03
                </option>
                <option<?php if ($ahora == "04") {
                    echo " selected";
                } ?> name="00" value="04">04
                </option>
                <option<?php if ($ahora == "05") {
                    echo " selected";
                } ?> name="00" value="05">05
                </option>
                <option<?php if ($ahora == "06") {
                    echo " selected";
                } ?> name="00" value="06">06
                </option>
                <option<?php if ($ahora == "07") {
                    echo " selected";
                } ?> name="00" value="07">07
                </option>
                <option<?php if ($ahora == "08") {
                    echo " selected";
                } ?> name="00" value="08">08
                </option>
                <option<?php if ($ahora == "09") {
                    echo " selected";
                } ?> name="00" value="09">09
                </option>
                <option<?php if ($ahora == "10") {
                    echo " selected";
                } ?> name="00" value="10">10
                </option>
                <option<?php if ($ahora == "11") {
                    echo " selected";
                } ?> name="00" value="11">11
                </option>
                <option<?php if ($ahora == "12") {
                    echo " selected";
                } ?> name="00" value="12">12
                </option>
                <option<?php if ($ahora == "13") {
                    echo " selected";
                } ?> name="00" value="13">13
                </option>
                <option<?php if ($ahora == "14") {
                    echo " selected";
                } ?> name="00" value="14">14
                </option>
                <option<?php if ($ahora == "15") {
                    echo " selected";
                } ?> name="00" value="15">15
                </option>
                <option<?php if ($ahora == "16") {
                    echo " selected";
                } ?> name="00" value="16">16
                </option>
                <option<?php if ($ahora == "17") {
                    echo " selected";
                } ?> name="00" value="17">17
                </option>
                <option<?php if ($ahora == "18") {
                    echo " selected";
                } ?> name="00" value="18">18
                </option>
                <option<?php if ($ahora == "19") {
                    echo " selected";
                } ?> name="00" value="19">19
                </option>
                <option<?php if ($ahora == "20") {
                    echo " selected";
                } ?> name="00" value="20">20
                </option>
                <option<?php if ($ahora == "21") {
                    echo " selected";
                } ?> name="00" value="21">21
                </option>
                <option<?php if ($ahora == "22") {
                    echo " selected";
                } ?> name="00" value="22">22
                </option>
                <option<?php if ($ahora == "23") {
                    echo " selected";
                } ?> name="00" value="23">23
                </option>
            </select>
        </div>
        <span class="col-sm-1"><h4>:</h4></span>

        <div class="col-sm-4 container">
            <select id="MinutosInicio" data-validetta="required" class="form-control ">
                <option name="00" value="00">00</option>
                <option name="00" value="01">05</option>
                <option name="00" value="02">10</option>
                <option name="00" value="03">15</option>
                <option name="00" value="04">20</option>
                <option name="00" value="05">25</option>
                <option name="00" value="06">30</option>
                <option name="00" value="07">35</option>
                <option name="00" value="08">40</option>
                <option name="00" value="09">45</option>
                <option name="00" value="10">50</option>
                <option name="00" value="11">55</option>
            </select>

        </div>
    </div>
                <br><br>
                <div class="form-group">
                    <label for="horaFin" class="col-sm-3 control-label">Hora de fin: </label>
                    <div class="col-sm-4 container">
                        <select id="HorasFin" data-validetta="required" class="form-control">
                            <option<?php if ($ahora == "00") {
                                echo " selected";
                            } ?> name="00" value="00">00
                            </option>
                            <option<?php if ($ahora == "01") {
                                echo " selected";
                            } ?> name="00" value="01">01
                            </option>
                            <option<?php if ($ahora == "02") {
                                echo " selected";
                            } ?> name="00" value="02">02
                            </option>
                            <option<?php if ($ahora == "03") {
                                echo " selected";
                            } ?> name="00" value="03">03
                            </option>
                            <option<?php if ($ahora == "04") {
                                echo " selected";
                            } ?> name="00" value="04">04
                            </option>
                            <option<?php if ($ahora == "05") {
                                echo " selected";
                            } ?> name="00" value="05">05
                            </option>
                            <option<?php if ($ahora == "06") {
                                echo " selected";
                            } ?> name="00" value="06">06
                            </option>
                            <option<?php if ($ahora == "07") {
                                echo " selected";
                            } ?> name="00" value="07">07
                            </option>
                            <option<?php if ($ahora == "08") {
                                echo " selected";
                            } ?> name="00" value="08">08
                            </option>
                            <option<?php if ($ahora == "09") {
                                echo " selected";
                            } ?> name="00" value="09">09
                            </option>
                            <option<?php if ($ahora == "10") {
                                echo " selected";
                            } ?> name="00" value="10">10
                            </option>
                            <option<?php if ($ahora == "11") {
                                echo " selected";
                            } ?> name="00" value="11">11
                            </option>
                            <option<?php if ($ahora == "12") {
                                echo " selected";
                            } ?> name="00" value="12">12
                            </option>
                            <option<?php if ($ahora == "13") {
                                echo " selected";
                            } ?> name="00" value="13">13
                            </option>
                            <option<?php if ($ahora == "14") {
                                echo " selected";
                            } ?> name="00" value="14">14
                            </option>
                            <option<?php if ($ahora == "15") {
                                echo " selected";
                            } ?> name="00" value="15">15
                            </option>
                            <option<?php if ($ahora == "16") {
                                echo " selected";
                            } ?> name="00" value="16">16
                            </option>
                            <option<?php if ($ahora == "17") {
                                echo " selected";
                            } ?> name="00" value="17">17
                            </option>
                            <option<?php if ($ahora == "18") {
                                echo " selected";
                            } ?> name="00" value="18">18
                            </option>
                            <option<?php if ($ahora == "19") {
                                echo " selected";
                            } ?> name="00" value="19">19
                            </option>
                            <option<?php if ($ahora == "20") {
                                echo " selected";
                            } ?> name="00" value="20">20
                            </option>
                            <option<?php if ($ahora == "21") {
                                echo " selected";
                            } ?> name="00" value="21">21
                            </option>
                            <option<?php if ($ahora == "22") {
                                echo " selected";
                            } ?> name="00" value="22">22
                            </option>
                            <option<?php if ($ahora == "23") {
                                echo " selected";
                            } ?> name="00" value="23">23
                            </option>
                        </select>
                    </div>
                    <span class="col-sm-1"><h4>:</h4></span>

                    <div class="col-sm-4 container">
                        <select id="MinutosFin" data-validetta="required" class="form-control ">
                            <option name="00" value="00">00</option>
                            <option name="00" value="01">05</option>
                            <option name="00" value="02">10</option>
                            <option name="00" value="03">15</option>
                            <option name="00" value="04">20</option>
                            <option name="00" value="05">25</option>
                            <option name="00" value="06">30</option>
                            <option name="00" value="07">35</option>
                            <option name="00" value="08">40</option>
                            <option name="00" value="09">45</option>
                            <option name="00" value="10">50</option>
                            <option name="00" value="11">55</option>
                        </select>

                    </div>
                </div>
                <br><br>

                <div class="form-group">
                    <label for="NºAlbaran" class="col-sm-3 control-label">Nº Albaran: </label>
                    <div class="col-sm-9">
                        <input type="text" id="Albaran" class="form-control" data-validetta="number" value="<?php echo $viaje->getAlbaran();?>">

                    </div>
                </div>
                <br><br>
                <div class="form-group" align="center">
                    <div class="col-sm-12 col-xs-offset-1">

                    <button type='button' id="modificar" class="btn btn-primary  modificar">Modificar</button>
                    <button type='button' id="salir" class='btn btn-warning salir'>Salir</button>
                    </div>
                </div>
                </form>




                <?php
            break;

            case 3:



            ?>



                <form class="form-horizontal">

                    <input type="hidden" name="idParte" value="">
                    <input type="hidden" name="jornadaElegida" id="jornadaElegida" value="">
                    <input type="hidden" name="fecha" id="fecha" value="">

<!--
                           *****************************************************
                        ESTO NO HACE FALTA PORQUE ESTE TRABAJADOR SOLO TIENE HORAS EXTRA Y UN SOLO TIPO DE JORNADA(ESQUEMA_BD)
                      *************************************************************


                            <div class="form-group">-->
<!---->
<!--                             <div class="radio col-xs-6 text-right">-->
<!---->
<!--                                 <input type="radio" name="tipoJornada" id="tipo1"  value="1" checked>Jornada Continua-->
<!---->
<!--                             </div>-->
<!---->
<!--                             <div class="radio col-xs-6 text-left">-->
<!--                                 <input type="radio" name="tipoJornada" id="tipo2" value="2">Jornada Partida-->
<!--                             </div>-->
<!---->
<!--                         </div>-->

                    <div class="form-group col-xs-12" style="display: none" id="jornada1">
                        <div class="">
                            <label for="horaInicio1" class="col-sm-3 control-label">Hora de inicio: </label>
                            <div class="col-sm-1 container">
                                <?php $now=new \DateTime();
                                $ahora=$now->format("H");

                                ?>
                                <select id="horasInicio1" data-validetta="required" class="form-control">
                                    <option<?php if($ahora=="00"){echo " selected";} ?> name="00" value="00">00</option>
                                    <option<?php if($ahora=="01"){echo " selected";} ?> name="00" value="01">01</option>
                                    <option<?php if($ahora=="02"){echo " selected";} ?> name="00" value="02">02</option>
                                    <option<?php if($ahora=="03"){echo " selected";} ?> name="00" value="03">03</option>
                                    <option<?php if($ahora=="04"){echo " selected";} ?> name="00" value="04">04</option>
                                    <option<?php if($ahora=="05"){echo " selected";} ?> name="00" value="05">05</option>
                                    <option<?php if($ahora=="06"){echo " selected";} ?> name="00" value="06">06</option>
                                    <option<?php if($ahora=="07"){echo " selected";} ?> name="00" value="07">07</option>
                                    <option<?php if($ahora=="08"){echo " selected";} ?> name="00" value="08">08</option>
                                    <option<?php if($ahora=="09"){echo " selected";} ?> name="00" value="09">09</option>
                                    <option<?php if($ahora=="10"){echo " selected";} ?> name="00" value="10">10</option>
                                    <option<?php if($ahora=="11"){echo " selected";} ?> name="00" value="11">11</option>
                                    <option<?php if($ahora=="12"){echo " selected";} ?> name="00" value="12">12</option>
                                    <option<?php if($ahora=="13"){echo " selected";} ?> name="00" value="13">13</option>
                                    <option<?php if($ahora=="14"){echo " selected";} ?> name="00" value="14">14</option>
                                    <option<?php if($ahora=="15"){echo " selected";} ?> name="00" value="15">15</option>
                                    <option<?php if($ahora=="16"){echo " selected";} ?> name="00" value="16">16</option>
                                    <option<?php if($ahora=="17"){echo " selected";} ?> name="00" value="17">17</option>
                                    <option<?php if($ahora=="18"){echo " selected";} ?> name="00" value="18">18</option>
                                    <option<?php if($ahora=="19"){echo " selected";} ?> name="00" value="19">19</option>
                                    <option<?php if($ahora=="20"){echo " selected";} ?> name="00" value="20">20</option>
                                    <option<?php if($ahora=="21"){echo " selected";} ?> name="00" value="21">21</option>
                                    <option<?php if($ahora=="22"){echo " selected";} ?> name="00" value="22">22</option>
                                    <option<?php if($ahora=="23"){echo " selected";} ?> name="00" value="23">23</option>
                                </select>
                            </div>

                            <div class="col-sm-1 container">
                                <select id="minInicio1" data-validetta="required" class="form-control ">
                                    <option name="00" value="00">00</option>
                                    <option name="00" value="05">05</option>
                                    <option name="00" value="10">10</option>
                                    <option name="00" value="15">15</option>
                                    <option name="00" value="20">20</option>
                                    <option name="00" value="25">25</option>
                                    <option name="00" value="30">30</option>
                                    <option name="00" value="35">35</option>
                                    <option name="00" value="40">40</option>
                                    <option name="00" value="45">45</option>
                                    <option name="00" value="50">50</option>
                                    <option name="00" value="55">55</option>
                                </select>

                            </div>

                         </div>

                        <div>
                            <label for="horasFin1" class="col-sm-3 control-label">Hora de fin: </label>
                            <div class="col-sm-1 container">
                                <select id="horasFin1" data-validetta="required" class="form-control">
                                    <option<?php if($ahora=="00"){echo " selected";} ?> name="00" value="00">00</option>
                                    <option<?php if($ahora=="01"){echo " selected";} ?> name="00" value="01">01</option>
                                    <option<?php if($ahora=="02"){echo " selected";} ?> name="00" value="02">02</option>
                                    <option<?php if($ahora=="03"){echo " selected";} ?> name="00" value="03">03</option>
                                    <option<?php if($ahora=="04"){echo " selected";} ?> name="00" value="04">04</option>
                                    <option<?php if($ahora=="05"){echo " selected";} ?> name="00" value="05">05</option>
                                    <option<?php if($ahora=="06"){echo " selected";} ?> name="00" value="06">06</option>
                                    <option<?php if($ahora=="07"){echo " selected";} ?> name="00" value="07">07</option>
                                    <option<?php if($ahora=="08"){echo " selected";} ?> name="00" value="08">08</option>
                                    <option<?php if($ahora=="09"){echo " selected";} ?> name="00" value="09">09</option>
                                    <option<?php if($ahora=="10"){echo " selected";} ?> name="00" value="10">10</option>
                                    <option<?php if($ahora=="11"){echo " selected";} ?> name="00" value="11">11</option>
                                    <option<?php if($ahora=="12"){echo " selected";} ?> name="00" value="12">12</option>
                                    <option<?php if($ahora=="13"){echo " selected";} ?> name="00" value="13">13</option>
                                    <option<?php if($ahora=="14"){echo " selected";} ?> name="00" value="14">14</option>
                                    <option<?php if($ahora=="15"){echo " selected";} ?> name="00" value="15">15</option>
                                    <option<?php if($ahora=="16"){echo " selected";} ?> name="00" value="16">16</option>
                                    <option<?php if($ahora=="17"){echo " selected";} ?> name="00" value="17">17</option>
                                    <option<?php if($ahora=="18"){echo " selected";} ?> name="00" value="18">18</option>
                                    <option<?php if($ahora=="19"){echo " selected";} ?> name="00" value="19">19</option>
                                    <option<?php if($ahora=="20"){echo " selected";} ?> name="00" value="20">20</option>
                                    <option<?php if($ahora=="21"){echo " selected";} ?> name="00" value="21">21</option>
                                    <option<?php if($ahora=="22"){echo " selected";} ?> name="00" value="22">22</option>
                                    <option<?php if($ahora=="23"){echo " selected";} ?> name="00" value="23">23</option>
                                </select>
                            </div>
                            <span class="col-sm-1"><h4>:</h4></span>

                            <div class="col-sm-1 container">
                                <select id="minFin1" data-validetta="required" class="form-control ">
                                    <option name="00" value="00">00</option>
                                    <option name="00" value="05">05</option>
                                    <option name="00" value="10">10</option>
                                    <option name="00" value="15">15</option>
                                    <option name="00" value="20">20</option>
                                    <option name="00" value="25">25</option>
                                    <option name="00" value="30">30</option>
                                    <option name="00" value="35">35</option>
                                    <option name="00" value="40">40</option>
                                    <option name="00" value="45">45</option>
                                    <option name="00" value="50">50</option>
                                    <option name="00" value="55">55</option>
                                </select>

                            </div>
                        </div>
                    </div>

<!--                   *****************************************************
                        ESTO NO HACE FALTA PORQUE ESTE TRABAJADOR SOLO TIENE HORAS EXTRA Y UN SOLO TIPO DE JORNADA(ESQUEMA_BD)
                      *************************************************************

                <div class="form-group col-xs-12" style="display: none" id="jornada2">-->
<!--                        <div class="">-->
<!--                            <label for="horaInicio2" class="col-sm-3 control-label">Hora de inicio: </label>-->
<!--                            <div class="col-sm-1 container">-->
<!--                                --><?php //$now=new \DateTime();
//                                $ahora=$now->format("H");
//
//                                ?>
<!--                                <select id="horasInicio2" data-validetta="required" class="form-control">-->
<!--                                    <option--><?php //if($ahora=="00"){echo " selected";} ?><!-- name="00" value="00">00</option>-->
<!--                                    <option--><?php //if($ahora=="01"){echo " selected";} ?><!-- name="00" value="01">01</option>-->
<!--                                    <option--><?php //if($ahora=="02"){echo " selected";} ?><!-- name="00" value="02">02</option>-->
<!--                                    <option--><?php //if($ahora=="03"){echo " selected";} ?><!-- name="00" value="03">03</option>-->
<!--                                    <option--><?php //if($ahora=="04"){echo " selected";} ?><!-- name="00" value="04">04</option>-->
<!--                                    <option--><?php //if($ahora=="05"){echo " selected";} ?><!-- name="00" value="05">05</option>-->
<!--                                    <option--><?php //if($ahora=="06"){echo " selected";} ?><!-- name="00" value="06">06</option>-->
<!--                                    <option--><?php //if($ahora=="07"){echo " selected";} ?><!-- name="00" value="07">07</option>-->
<!--                                    <option--><?php //if($ahora=="08"){echo " selected";} ?><!-- name="00" value="08">08</option>-->
<!--                                    <option--><?php //if($ahora=="09"){echo " selected";} ?><!-- name="00" value="09">09</option>-->
<!--                                    <option--><?php //if($ahora=="10"){echo " selected";} ?><!-- name="00" value="10">10</option>-->
<!--                                    <option--><?php //if($ahora=="11"){echo " selected";} ?><!-- name="00" value="11">11</option>-->
<!--                                    <option--><?php //if($ahora=="12"){echo " selected";} ?><!-- name="00" value="12">12</option>-->
<!--                                    <option--><?php //if($ahora=="13"){echo " selected";} ?><!-- name="00" value="13">13</option>-->
<!--                                    <option--><?php //if($ahora=="14"){echo " selected";} ?><!-- name="00" value="14">14</option>-->
<!--                                    <option--><?php //if($ahora=="15"){echo " selected";} ?><!-- name="00" value="15">15</option>-->
<!--                                    <option--><?php //if($ahora=="16"){echo " selected";} ?><!-- name="00" value="16">16</option>-->
<!--                                    <option--><?php //if($ahora=="17"){echo " selected";} ?><!-- name="00" value="17">17</option>-->
<!--                                    <option--><?php //if($ahora=="18"){echo " selected";} ?><!-- name="00" value="18">18</option>-->
<!--                                    <option--><?php //if($ahora=="19"){echo " selected";} ?><!-- name="00" value="19">19</option>-->
<!--                                    <option--><?php //if($ahora=="20"){echo " selected";} ?><!-- name="00" value="20">20</option>-->
<!--                                    <option--><?php //if($ahora=="21"){echo " selected";} ?><!-- name="00" value="21">21</option>-->
<!--                                    <option--><?php //if($ahora=="22"){echo " selected";} ?><!-- name="00" value="22">22</option>-->
<!--                                    <option--><?php //if($ahora=="23"){echo " selected";} ?><!-- name="00" value="23">23</option>-->
<!--                                </select>-->
<!--                            </div>-->
<!--                            <span class="col-sm-1"><h4>:</h4></span>-->
<!---->
<!--                            <div class="col-sm-1 container">-->
<!--                                <select id="minInicio2" data-validetta="required" class="form-control ">-->
<!--                                    <option name="00" value="00">00</option>-->
<!--                                    <option name="00" value="05">05</option>-->
<!--                                    <option name="00" value="10">10</option>-->
<!--                                    <option name="00" value="15">15</option>-->
<!--                                    <option name="00" value="20">20</option>-->
<!--                                    <option name="00" value="25">25</option>-->
<!--                                    <option name="00" value="30">30</option>-->
<!--                                    <option name="00" value="35">35</option>-->
<!--                                    <option name="00" value="40">40</option>-->
<!--                                    <option name="00" value="45">45</option>-->
<!--                                    <option name="00" value="50">50</option>-->
<!--                                    <option name="00" value="55">55</option>-->
<!--                                </select>-->
<!---->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!--                        <div>-->
<!--                            <label for="horaFin2" class="col-sm-3 control-label">Hora de fin: </label>-->
<!--                            <div class="col-sm-1 container">-->
<!--                                <select id="horasFin2" data-validetta="required" class="form-control">-->
<!--                                    <option--><?php //if($ahora=="00"){echo " selected";} ?><!-- name="00" value="00">00</option>-->
<!--                                    <option--><?php //if($ahora=="01"){echo " selected";} ?><!-- name="00" value="01">01</option>-->
<!--                                    <option--><?php //if($ahora=="02"){echo " selected";} ?><!-- name="00" value="02">02</option>-->
<!--                                    <option--><?php //if($ahora=="03"){echo " selected";} ?><!-- name="00" value="03">03</option>-->
<!--                                    <option--><?php //if($ahora=="04"){echo " selected";} ?><!-- name="00" value="04">04</option>-->
<!--                                    <option--><?php //if($ahora=="05"){echo " selected";} ?><!-- name="00" value="05">05</option>-->
<!--                                    <option--><?php //if($ahora=="06"){echo " selected";} ?><!-- name="00" value="06">06</option>-->
<!--                                    <option--><?php //if($ahora=="07"){echo " selected";} ?><!-- name="00" value="07">07</option>-->
<!--                                    <option--><?php //if($ahora=="08"){echo " selected";} ?><!-- name="00" value="08">08</option>-->
<!--                                    <option--><?php //if($ahora=="09"){echo " selected";} ?><!-- name="00" value="09">09</option>-->
<!--                                    <option--><?php //if($ahora=="10"){echo " selected";} ?><!-- name="00" value="10">10</option>-->
<!--                                    <option--><?php //if($ahora=="11"){echo " selected";} ?><!-- name="00" value="11">11</option>-->
<!--                                    <option--><?php //if($ahora=="12"){echo " selected";} ?><!-- name="00" value="12">12</option>-->
<!--                                    <option--><?php //if($ahora=="13"){echo " selected";} ?><!-- name="00" value="13">13</option>-->
<!--                                    <option--><?php //if($ahora=="14"){echo " selected";} ?><!-- name="00" value="14">14</option>-->
<!--                                    <option--><?php //if($ahora=="15"){echo " selected";} ?><!-- name="00" value="15">15</option>-->
<!--                                    <option--><?php //if($ahora=="16"){echo " selected";} ?><!-- name="00" value="16">16</option>-->
<!--                                    <option--><?php //if($ahora=="17"){echo " selected";} ?><!-- name="00" value="17">17</option>-->
<!--                                    <option--><?php //if($ahora=="18"){echo " selected";} ?><!-- name="00" value="18">18</option>-->
<!--                                    <option--><?php //if($ahora=="19"){echo " selected";} ?><!-- name="00" value="19">19</option>-->
<!--                                    <option--><?php //if($ahora=="20"){echo " selected";} ?><!-- name="00" value="20">20</option>-->
<!--                                    <option--><?php //if($ahora=="21"){echo " selected";} ?><!-- name="00" value="21">21</option>-->
<!--                                    <option--><?php //if($ahora=="22"){echo " selected";} ?><!-- name="00" value="22">22</option>-->
<!--                                    <option--><?php //if($ahora=="23"){echo " selected";} ?><!-- name="00" value="23">23</option>-->
<!--                                </select>-->
<!--                            </div>-->
<!--                            <span class="col-sm-1"><h4>:</h4></span>-->
<!---->
<!--                            <div class="col-sm-1 container">-->
<!---->
<!--                                <select id="minFin2" data-validetta="required" class="form-control ">-->
<!--                                    <option name="00" value="00">00</option>-->
<!--                                    <option name="00" value="05">05</option>-->
<!--                                    <option name="00" value="10">10</option>-->
<!--                                    <option name="00" value="15">15</option>-->
<!--                                    <option name="00" value="20">20</option>-->
<!--                                    <option name="00" value="25">25</option>-->
<!--                                    <option name="00" value="30">30</option>-->
<!--                                    <option name="00" value="35">35</option>-->
<!--                                    <option name="00" value="40">40</option>-->
<!--                                    <option name="00" value="45">45</option>-->
<!--                                    <option name="00" value="50">50</option>-->
<!--                                    <option name="00" value="55">55</option>-->
<!--                                </select>-->
<!---->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!--                    </div>-->


                        <div class="form-group col-sm-4">
                        <label class="col-sm-6 control-label">Autopista/Peajes:</label>
                        <div class="input-group col-sm-3">
                            <input type="text" class="form-control" name="autopista" id="autopista"
                                   aria-describedby="basic-addon2">
                            <span class="input-group-addon" id="basic-addon2">€</span>
                        </div>
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="col-sm-6 control-label">Dietas:</label>
                        <div class="input-group col-sm-3">
                            <input type="text" class="form-control" name="dieta" id="dietas"
                                   aria-describedby="basic-addon2">
                            <span class="input-group-addon" id="basic-addon2">€</span>
                        </div>
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="col-sm-6 control-label">Otros Gastos:</label>
                        <div class="input-group col-sm-3">
                            <input type="text" class="form-control" name="otroGastos" id="otrosGastos"
                                   aria-describedby="basic-addon2">
                            <span class="input-group-addon" id="basic-addon2">€</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Incidencias:</label>
                        <div class="input-group col-sm-6">
                            <textarea class="form-control" name="incidencias" id="incidencias" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group col-xs-12">
                        <button type="button" id="bCerrarParte" name="bCerrarParte" class="btn btn-primary bCerrarParte">Cerrar
                        </button>
                        <button type='button' id="salir" class='btn btn-warning salir'>Salir</button>
                    </div>
                    </div>


<!--                    <script>-->
<!--                        $(document).ready(function(){-->
<!--                            $("input[name='tipoJornada']").click(function(){-->
<!--                                var valor = $(this).val();-->
<!--                                if(valor=="1"){-->
<!--                                    $("#jornada1").css("display","block");-->
<!--                                    $("#jornada2").css("display","none");-->
<!--                                    $("#bCerrarParte").css("display","block");-->
<!--                                    $('#jornadaElegida').val(1);-->
<!--                                }else if(valor=="2"){-->
<!--                                    $("#jornada1").css("display","inline");-->
<!--                                    $("#jornada2").css("display","inline");-->
<!--                                    $("#bCerrarParte").css("display","block");-->
<!--                                    $('#jornadaElegida').val(2);-->
<!--                                }-->
<!--                            });-->
<!--                        });-->
<!---->
<!--                    </script>-->

                </form>





<?php
        }
    }

?>



