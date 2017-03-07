<?php
session_start();
use Vista\Plantilla;
use Modelo\BD;


error_reporting(-1);
require_once __DIR__."/../../Modelo/BD/CalendarioBD.php";
require_once __DIR__."/../../Modelo/BD/PartesLogisticaBD.php";
require_once __DIR__."/../../Modelo/BD/TrabajadorBD.php";
require_once __DIR__."/../../Modelo/BD/ViajeBD.php";
require_once __DIR__."/../../Modelo/BD/EstadoBD.php";
require_once __DIR__."/../../Modelo/Base/LogisticaClass.php";
require_once __DIR__."/../../Modelo/Base/VehiculoClass.php";
require_once __DIR__."/../../Modelo/Base/ParteLogisticaClass.php";
require_once __DIR__."/../../Modelo/Base/ViajeClass.php";
require_once __DIR__."/../../Vista/Plantilla/Views.php";


function fecha ($valor)
{
	$timer = explode(" ",$valor);
	$fecha = explode("-",$timer[0]);
	$fechex = $fecha[2]."/".$fecha[1]."/".$fecha[0];
	return $fechex;
}

function buscar_en_array($fecha,$array)
{
	$total_eventos=count($array);
	for($e=0;$e<$total_eventos;$e++)
	{
		if ($array[$e]["fecha"]==$fecha) return true;
	}
}

switch ($_POST["accion"])
{
	case "listar_viaje":
	{
		$trabajador=unserialize($_SESSION['trabajador']);
		$parte= BD\ParteslogisticaBD::getParteByTrabajadorFecha($trabajador,$_POST['fecha']);
		$viajes= Modelo\BD\ViajeBD::getViajesByParte($parte);

		echo "<div class='table-responsive'>";



		if($parte->getEstado()==1) {

			echo "<table class='table table-striped'><tr><th >ID</th><th >HORA INICIO</th><th >HORA FIN</th><th >VEHICULO</th><th >ALBARAN</th><th >ACCIONES</th></tr>";
			foreach ($parte->getViajes() as $viaje) {

				echo "<tr> <td>" . $viaje->getId() . "</td><td>" . $viaje->getHoraInicio() . "</td><td>" . $viaje->getHoraFin() . "</td><td>" . $viaje->getVehiculo()->getMatricula() . "</td><td>" . $viaje->getAlbaran() . "</td> 
				  
				  <td><article class='col-xs-10'>
				  <a class='tOp eliminar_evento' rel='".$viaje->getId()."'><span class='glyphicon glyphicon-trash' aria-hidden='true' style='color:red'></span></a>
				  <a class='tOp editar_viaje' rel='".$viaje->getId()."'><span class='glyphicon glyphicon-edit' aria-hidden='true' style='color:blue'></span></a></article>
				  </td></tr>";


			}


			echo "</table>";

			echo"<div class='form-group' align='center'>
			<button type='button' id='cerrarParte' class='btn btn-primary cerrarParte'>Cerrar Parte</button>
            <button type='button' id='eliminarP' class='btn btn-danger eliminarP'>Eliminar Parte</button>
			<button type='button' id='salir' class='btn btn-warning salir'>Salir</button>

            </div>";

		}

        else{


          echo "<div class='alert alert-success col-xs-8 col-xs-offset-2' align='center' role='alert'>El Parte está cerrado.</div>";
            echo"<div class='col-xs-8 col-xs-offset-2' align='center'>
			
			<button type='button' id='salir' class='btn btn-warning salir'>Salir</button>

            </div>";



        }




		break;
	}

    case "borrar_parte":
    {

        $parte = new \Modelo\Base\ParteLogistica($_POST["idParte"]);
        echo "<div class='alert alert-success col-xs-8 col-xs-offset-2' role='alert'>".$parte->remove()."</div>";
        /*creamos el botón que nos llevará al calendario*/
        echo "<div class='col-xs-8 col-xs-offset-2'><button type='button' class='btn btn-warning salir' rel='".$parte->getId()."'>Salir</button></div>";

        break;
    }



//	case "guardar_evento":
//	{
//		$query=$db->query("insert into parteslogistica (fecha,evento) values ('".$_POST["fecha"]."','".strip_tags($_POST["evento"])."')");
//		if ($query) echo "<p class='ok'>El viaje se ha guardado correctamente.</p>";
//		else echo "<p class='error'>Se ha producido un error guardando el viaje.</p>";
//		break;
//	}
	case "borrar_viaje":
	{
		$query=$db->query("delete from viajes where id='".$_POST["id"]."' limit 1");
		if ($query) echo"<div class='alert alert-success col-xs-8 col-xs-offset-2' role='alert'>Viaje eliminado correctamente.</div>";
		else echo "<p class='error'>Se ha producido un error eliminando el viaje.</p>";
		break;
	}

    case "modificar_viaje":
    {

        $vehiculo= BD\VehiculoBD::getVehiculoByMatricula($_POST['vehiculo']);
        $viaje= new Modelo\Base\Viaje($_POST['id'],$_POST['horasInicio'],$_POST['horasFin'],$_POST['albaran'],$vehiculo,null);

        echo "<div class='alert alert-success col-xs-8 col-xs-offset-2' align='center' role='alert'>".$viaje->modificar()."</div>";
        echo"<div class='col-xs-8 col-xs-offset-2' align='center'>
			
			<button type='button' id='salir' class='btn btn-warning salir'>Salir</button>

            </div>";
        break;
    }





    case "cerrar_parte":

	{
	    $fecha= $_POST["fecha"];

        $trabajador = unserialize($_SESSION["trabajador"]);

        $parte = BD\ParteslogisticaBD::getParteByTrabajadorFecha($trabajador,$_POST['fecha']);
        $estado=BD\EstadoBD::selectEstdadoByTipo("cerrado");

        $parte->setNota($_POST['incidencias']);
        $parte->setAutopista($_POST['autopista']);
        $parte->setDieta($_POST['dietas']);
        $parte->setOtroGasto($_POST['otrosGastos']);
        $parte->setEstado($estado);

        $parte->cerrarParte();

        //$jornadaElegida = intval($_POST["jornadaElegida"]);


        echo "<div class='alert alert-success' id='fres' role='alert'>Acabas de cerrar el parte</div>";
        echo "<div class='col-xs-8 col-xs-offset-2'><button type='button' class='btn btn-warning pSalir' rel='".$parte->getId()."'>Salir</button></div>";


        break;
    }


    case "generar_calendario":
    {
        $fecha_calendario=array();
        if ($_POST["mes"]=="" || $_POST["anio"]=="")
        {
            $fecha_calendario[1]=intval(date("m"));
            if ($fecha_calendario[1]<10) $fecha_calendario[1]="0".$fecha_calendario[1];
            $fecha_calendario[0]=date("Y");
        }
        else
        {
            $fecha_calendario[1]=intval($_POST["mes"]);
            if ($fecha_calendario[1]<10) $fecha_calendario[1]="0".$fecha_calendario[1];
            else $fecha_calendario[1]=$fecha_calendario[1];
            $fecha_calendario[0]=$_POST["anio"];
        }
        $fecha_calendario[2]="01";

        /* obtenemos el dia de la semana del 1 del mes actual */
        $primeromes=date("N",mktime(0,0,0,$fecha_calendario[1],1,$fecha_calendario[0]));

        /* comprobamos si el a�o es bisiesto y creamos array de d�as */
        if (($fecha_calendario[0] % 4 == 0) && (($fecha_calendario[0] % 100 != 0) || ($fecha_calendario[0] % 400 == 0))) $dias=array("","31","29","31","30","31","30","31","31","30","31","30","31");
        else $dias=array("","31","28","31","30","31","30","31","31","30","31","30","31");

        $eventos=array();
        $query=$db->query("select fecha,count(id) as total from parteslogistica where month(fecha)='".$fecha_calendario[1]."' and year(fecha)='".$fecha_calendario[0]."' group by fecha");
        if ($fila=$query->fetch_array())
        {
            do
            {
                $eventos[$fila["fecha"]]=$fila["total"];
            }
            while($fila=$query->fetch_array());

        }

        $meses=array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        /* calculamos los d�as de la semana anterior al d�a 1 del mes en curso */
        $diasantes=$primeromes-1;

        /* los d�as totales de la tabla siempre ser�n m�ximo 42 (7 d�as x 6 filas m�ximo) */
        $diasdespues=42;

        /* calculamos las filas de la tabla */
        $tope=$dias[intval($fecha_calendario[1])]+$diasantes;
        if ($tope%7!=0) $totalfilas=intval(($tope/7)+1);
        else $totalfilas=intval(($tope/7));

        /* empezamos a pintar la tabla */
        echo "<h2 align='center'>".$meses[intval($fecha_calendario[1])]." del ".$fecha_calendario[0]." <abbr title='S&oacute;lo se pueden agregar eventos en d&iacute;as h&aacute;biles y en fechas futuras (o la fecha actual).'></abbr></h2>";
        if (isset($mostrar)) echo $mostrar;

        echo "<table class='calendario table table-bordered table-responsive' cellspacing='0' cellpadding='0'>";
        echo "<tr><th>Lunes</th><th>Martes</th><th>Mi&eacute;rcoles</th><th>Jueves</th><th>Viernes</th><th>S&aacute;bado</th><th>Domingo</th></tr><tr>";

        /* inicializamos filas de la tabla */
        $tr=0;
        $dia=1;

        function es_finde($fecha)
        {
            $cortamos=explode("-",$fecha);
            $dia=$cortamos[2];
            $mes=$cortamos[1];
            $ano=$cortamos[0];
            $fue=date("w",mktime(0,0,0,$mes,$dia,$ano));
            if (intval($fue)==0 || intval($fue)==6) return true;
            else return false;
        }

        for ($i=1;$i<=$diasdespues;$i++)
        {
            if ($tr<$totalfilas)
            {
                if ($i>=$primeromes && $i<=$tope)
                {
                    echo "<td class='";
                    /* creamos fecha completa */
                    if ($dia<10) $dia_actual="0".$dia; else $dia_actual=$dia;
                    $fecha_completa=$fecha_calendario[0]."-".$fecha_calendario[1]."-".$dia_actual;

                    if (intval($eventos[$fecha_completa])>0)
                    {
                        echo "evento";
                        $hayevento=$eventos[$fecha_completa];
                    }
                    else $hayevento=0;

                    /* si es hoy coloreamos la celda */
                    if (date("Y-m-d")==$fecha_completa) echo " hoy";

                    echo "'>";

                    /* recorremos el array de eventos para mostrar los eventos del d�a de hoy */
                    if ($hayevento>0) {
                        echo "<a href='#' data-evento='#evento" . $dia_actual . "' class='mod' rel='" . $fecha_completa . "' title='Hay un Parte' ";if (date("Y-m-d")==$fecha_completa) echo " style='font-weight:500;'";echo ">" . $dia . "</a>";
                    }else echo "$dia";

                    /* agregamos enlace a nuevo evento si la fecha no ha pasado */
                    $trabajador = unserialize($_SESSION["trabajador"]);
                    $parte = Modelo\BD\PartesLogisticaBD::getPartebyTrabajadorAndFecha($trabajador,$fecha_completa);
                    $hoy = new \DateTime();

                    if(!is_null($parte)){
                        $estado = Modelo\BD\EstadoBD::selectEstadoByParteLogistica($parte);
                        if (strnatcasecmp($estado->getTipo(),"abierto")==0) echo "<a href='#' data-evento='#nuevo_evento' title='Agregar un Evento el ".fecha($fecha_completa)."' class='add agregar_evento' rel='".$fecha_completa."'>&nbsp;</a>";
                    }else if($fecha_completa<=$hoy->format("Y-m-d")){
                        echo "<a href='#' data-evento='#nuevo_evento' title='Agregar un Evento el ".fecha($fecha_completa)."' class='add agregar_evento' rel='".$fecha_completa."'>&nbsp;</a>";
                    }

                    echo "</td>";
                    $dia+=1;
                }
                else echo "<td class='desactivada'>&nbsp;</td>";

                if ($i==7 || $i==14 || $i==21 || $i==28 || $i==35 || $i==42) {echo "<tr>";$tr+=1;}
            }
        }
        echo "</table>";

        $mesanterior=date("Y-m-d",mktime(0,0,0,$fecha_calendario[1]-1,01,$fecha_calendario[0]));
        $messiguiente=date("Y-m-d",mktime(0,0,0,$fecha_calendario[1]+1,01,$fecha_calendario[0]));
        $hoyEnlace = date("Y-m-d");

        echo "<ul class='pager'>
					<li><a href='#' rel='$mesanterior' class='anterior'><span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span>Mes Anterior</a></li>
					<li><a href='#' rel='$hoyEnlace' class='hoyEnlace'>Hoy</a></li>
					<li><a href='#' class='siguiente' rel='$messiguiente'>Mes Siguiente<span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span></a></li>";

        break;
    }


     case "addViaje":{
        //MIRO SESSION SI EXISTE PARTE
        if(isset($_SESSION['Parte']) && unserialize($_SESSION["Parte"])->getFecha() == $_POST["fecha"]){
            $parte=unserialize($_SESSION['Parte']);
            $viaje=new Modelo\Base\Viaje(null,$_POST['horaInicio'],$_POST['horaFin'],$_POST['albaran'],new Modelo\Base\Vehiculo($_POST['vehiculo']),$parte);
            echo "<div class='alert alert-success' role='alert'>".Modelo\BD\ViajeBD::add($viaje)."</div>";

        }
        else{
            $trabajador=unserialize($_SESSION['trabajador']);
            $fecha=new \DateTime($_POST['fecha']);
            $parte= BD\PartesLogisticaBD::getParteByTrabajadorFecha($trabajador,$fecha->format('Y-m-d'));
            if($parte!=null){
                //insert viaje En ese parte
                $_SESSION['Parte']=serialize($parte);
                $viaje=new Modelo\Base\Viaje(null,$_POST['horaInicio'],$_POST['horaFin'],$_POST['albaran'],new Modelo\Base\Vehiculo($_POST['vehiculo']),$parte);
                echo "<div class='alert alert-success' role='alert'>".Modelo\BD\ViajeBD::add($viaje)."</div>";

            }
            else{
                $fecha=new \DateTime($_POST['fecha']);
                $parte=new Modelo\Base\ParteLogistica(null,$fecha->format('Y-m-d'),null,null,null,null,new Modelo\Base\Estado(1,null), $trabajador,null);
                $id=Modelo\BD\PartesLogisticaBD::add($parte);

                //$_POST['Parte']=serialize($parte);
                $parte->setId($id);

                $viaje=new Modelo\Base\Viaje(null,$_POST['horaInicio'],$_POST['horaFin'],$_POST['albaran'],new Modelo\Base\Vehiculo($_POST['vehiculo']),$parte);
                echo "<div class='alert alert-success' role='alert'>".Modelo\BD\ViajeBD::add($viaje)."</div>";

            }
        }


         break;
    }










    /*case "addViaje":{
			//MIRO SESSION SI EXISTE PARTE
       $trabajador= unserialize($_SESSION['trabajador']);
       echo $trabajador->getDni();
       $parte= unserialize($_SESSION['parteLogistica']);
       echo $parte->getId();
        $fecha=$_POST['fecha'];
        $parte= BD\ParteslogisticaBD::getParteByTrabajadorFecha($trabajador,$fecha);

        if(is_null($parte)){//Si no esta
            //Buscamos el estado abierto en la base de datos
            $estado = BD\EstadoBD::selectEstdadoByTipo("abierto");
            //Creamos el parte lo guardamos y lo recuperamos
            $parte = new \Modelo\Base\ParteLogistica(null,$fecha->format("Y-m-d"),null,null,null,null,$estado,$trabajador,null);
            $parte->save();
            $parte =BD\ParteslogisticaBD::getParteByTrabajadorFecha($trabajador,$fecha);
        }





			if(isset($_SESSION['Parte']) && unserialize($_SESSION["Parte"])->getFecha() == $_POST["fecha"]){
				$parte=unserialize($_SESSION['Parte']);
				$viaje=new Modelo\Base\Viaje(null,$_POST['horaInicio'],$_POST['horaFin'],$_POST['albaran'],new Modelo\Base\Vehiculo($_POST['vehiculo']),$parte);
				echo "<div class='alert alert-success' role='alert'>".Modelo\BD\ViajeBD::add($viaje)."</div>";
			}
			else{
				$trabajador=unserialize($_SESSION['trabajador']);
				$fecha=new \DateTime($_POST['fecha']);
				$parte= BD\ParteslogisticaBD::getParteByTrabajadorFecha($trabajador,$fecha);
				if($parte!=null){
					//insert viaje En ese parte
					$_SESSION['Parte']=serialize($parte);
					$viaje=new Modelo\Base\Viaje(null,$_POST['horaInicio'],$_POST['horaFin'],$_POST['albaran'],new Modelo\Base\Vehiculo		($_POST['vehiculo']),$parte);
					echo "<div class='alert alert-success' role='alert'>".Modelo\BD\ViajeBD::add($viaje)."</div>";

				}
				else{
					$fecha=new \DateTime($_POST['fecha']);
					$parte=new Modelo\Base\ParteLogistica(null,$fecha->format('Y-m-d'),null,null,null,null,new Modelo\Base\Estado(1,null), $trabajador,null);
					$id=Modelo\BD\ParteslogisticaBD::add($parte);

					//$_POST['Parte']=serialize($parte);
					$parte->setId($id);

					$viaje=new Modelo\Base\Viaje(null,$_POST['horaInicio'],$_POST['horaFin'],$_POST['albaran'],new Modelo\Base\Vehiculo		($_POST['vehiculo']),$parte);
					echo "<div class='alert alert-success' role='alert'>".Modelo\BD\ViajeBD::add($viaje)."</div>";

				}
			}


		break;
	}*/
}
?>