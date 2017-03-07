<?php
namespace Vista\Logistica;
use Vista\Plantilla;
/**
 * Created by PhpStorm.
 * User: Nestor
 * Date: 02/03/2016
 * Time: 8:53
 */

require_once __DIR__.'/../../Modelo/BD/GenericoBD.php';;
require_once __DIR__.'/../Plantilla/Views.php';



abstract class CalendarioViews extends Plantilla\Views
{

public static function generarcalendario(){


    parent::setOn(true);
    require_once __DIR__."/../Plantilla/Cabecera.php";
    ?>


    <link type="text/css" rel="stylesheet" media="all" href="<?php echo parent::getUrlRaiz()?>/Vista/Plantilla/CSS/Bootstrap/estilos.css">


    <div class="calendario_ajax">
        <div class="cal"></div><div id="mask"></div>
    </div>

    <script src="<?php echo parent::getUrlRaiz();?>/Vista/Plantilla/JS/jquery-2.2.1.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/localization/messages_es.js "></script>


    <script>
        function generar_calendario(mes,anio)
        {
            var agenda=$(".cal");
            agenda.html("<img src='<?php echo parent::getUrlRaiz()?>/Vista/Plantilla/IMG/loading.gif' alt='Loading'");
            $.ajax({
                type: "POST",
                url: "<?php echo parent::getUrlRaiz()?>/Controlador/Logistica/ControladorCalendario.php",
                cache: false,
                data: { mes:mes,anio:anio,accion:"generar_calendario" }
            }).done(function( respuesta )
            {
                agenda.html(respuesta);
            });
        }

        function formatDate (input) {
            var datePart = input.match(/\d+/g),
                year = datePart[0].substring(0),
                month = datePart[1], day = datePart[2];
            return day+'-'+month+'-'+year;
        }

        $(document).ready(function()
        { //AÑADIR EL VIAJE RECOGIENDO FORMULARIO

            /* GENERAMOS CALENDARIO CON FECHA DE HOY */
            generar_calendario("<?php if (isset($_GET["mes"])) echo $_GET["mes"]; ?>","<?php if (isset($_GET["anio"])) echo $_GET["anio"]; ?>");


            /* AGREGAR UN VIAJE */
            $(document).on("click",'a.add',function(e)
            {
                e.preventDefault();
               // var id = $(this).data('evento');
                var fecha = $(this).attr('rel');

                $(".cal").fadeOut(500);

                $.ajax({
                    type: "POST",
                    url: "<?php echo parent::getUrlRaiz()?>/Vista/Logistica/GeneradorFormsViews.php",
                    cache: false,
                    data: {fecha:formatDate(fecha),cod:1 }
                }).done(function( respuesta ){
                    if(respuesta==false){
                        $("#respuesta_form").html("<div class='alert alert-danger' role='alert'><strong>Error:</strong> La fecha del Parte es Incorrecta.</div>");
                        $(".formeventos").css("display","none")
                    }else{
                        $(".formeventos").html(respuesta);
                    }
                });

                $('#mask').fadeIn(700)
                .html(

                    "<div id='nuevo_evento col-xs-12 text-center'rel='"+fecha+"'>" +
                        "<h2 align='center'>Parte de "+formatDate(fecha)+"</h2>" +
                    "</div>" +
                    "<div class='row window' rel='"+fecha+"'>"+
                        "<div id='respuesta_form' class='col-xs-12 col-md-8 col-md-offset-2'></div>" +
                        "<div class='col-xs-12 col-md-8 col-md-offset-1'>"+
                            "<form class='formeventos form-horizontal'>" +
                                //"<input type='text' name='evento_titulo' id='evento_titulo' class='required'>" +
                                //"<input type='button' name='Enviar' value='Guardar' class='enviar'>" +
                                "<input type='hidden' name='evento_fecha' id='evento_fecha' value='"+fecha+"'>" +
                            "</form>"+
                        "</div>"+
                    "</div>");
                });



        /* LISTAR EVENTOS DEL DIA */
            $(document).on("click",'a.mod',function(e)
            {
                e.preventDefault();
                var fecha = $(this).attr('rel');
                $(".cal").fadeOut(500);

                $('#mask').fadeIn(1500).html("<div id='nuevo_evento' class='window' rel='"+fecha+"'><h2>Viajes del "+formatDate(fecha)+"</h2>" +
                    "<a href='#' class='cerrar' rel='"+fecha+"'>&nbsp;</a>" +
                    "<div id='respuesta'></div><div id='respuesta_form'></div></div>");
                $.ajax({
                    type: "POST",
                    url: "<?php echo parent::getUrlRaiz()?>/Controlador/Logistica/ControladorCalendario.php",
                    cache: false,
                    data: { fecha:fecha,accion:"listar_viaje" }
                }).done(function( respuesta )
                {

                    $("#respuesta_form").html(respuesta);
                });

            });





            $(document).on("click",".cerrarParte",function(e){
                e.preventDefault();
                var fecha = $(this).attr('rel');

                $.ajax({
                    type: "POST",
                    url: "<?php echo parent::getUrlRaiz()?>/Vista/Logistica/GeneradorFormsViews.php",
                    cache: false,
                    data: { fecha:fecha,cod:3}
                }).done(function( respuesta2 )
                {
                    $("#respuesta").html(respuesta2);

                });
            });

            //GUARDAR EL PARTE CERRADO
            $(document).on("click","#bCerrarParte",function(e){

                e.preventDefault();
                var fecha = $(".window").attr("rel");

                var horasInicio1 = $('#horasInicio1').val();
                var minInicio1 = $('#minInicio1').val();
                var horasFin1 =$('#horasFin1').val();
                var minFin1 = $('#minFin1').val();

                var horasInicio2 = $('#horasInicio2').val();
                var minInicio2 = $('#minInicio2').val();
                var horasFin2 =$('#horasFin2').val();
                var minFin2 = $('#minFin2').val();

                var autopista = $('#autopista').val();
                var dietas = $('#dietas').val();
                var otrosGastos= $('#otrosGastos').val();
                var incidencias = $('#incidencias').val();



                $.ajax({
                    type: "POST",
                    url: "<?php echo parent::getUrlRaiz()?>/Controlador/Logistica/ControladorCalendario.php",
                    cache: false,
                    data: { fecha:fecha,horasInicio1:horasInicio1,minInicio1:minInicio1,horasFin1:horasFin1,minFin1:minFin1,horasInicio2:horasInicio2,minInicio2:minInicio2,horasFin2:horasFin2,minFin2:minFin2,autopista:autopista,dietas:dietas,otrosGastos:otrosGastos,incidencias:incidencias,jornadaElegida:$('#jornadaElegida').val(),accion:"cerrar_parte"}
                }).done(function(respuesta)
                {
                    $("#respuesta_form").css("display","none");
                    $("#respuesta").html(respuesta);
                    setTimeout(function(){

                        $(".close").trigger("click");
                    },2200);


                });
            });


            //SALIR DE LOS PARTES
            $(document).on("click",'.salir',function (e)
            {
                e.preventDefault();

                setTimeout(function(){$("#mask").css("display","none")},20);

                $(".cal").fadeIn(700);
                var fecha=$(".window").attr("rel");
                var fechacal=fecha.split("-");
                generar_calendario(fechacal[1],fechacal[0]);

            });

            //ELIMINAR PARTE
            $(document).on("click",".eliminarP",function(e){

                e.preventDefault();
                var idParte = $("#idParte").val();

                var confirmar= confirm("¿Estas seguro de querer borrar este parte?");

                if(confirmar){

                    $.ajax({
                        type: "POST",
                        url: "<?php echo parent::getUrlRaiz()?>/Controlador/Logistica/ControladorCalendario.php",
                        cache: false,
                        data: { idParte:idParte,accion:"borrar_parte" }
                    }).done(function( respuesta2 )
                    {
                        $('.table-responsive').css("display","none");
                        $("#respuesta").html(respuesta2);

                        setTimeout(function(){
                            $(".close").trigger("click");
                        },2200);

                    });
                    return true;

                }
                else{
                    return false;
                }


            });



            //guardar viaje
            $(document).on("click",'.enviar',function (e)
            {
                e.preventDefault();

                var vehiculo=$('#Vehiculo').val();
                var horaInicio=$('#HorasInicio').val()+":"+$('#MinutosInicio').val()+":00";
                var horaFin=$('#HorasFin').val()+":"+$('#MinutosFin').val()+":00";
                var albaran=$('#Albaran').val();
                var fecha=$('#FechaHoy').val();


                $.ajax({
                    type: "POST",
                    url: "<?php echo parent::getUrlRaiz()?>/Controlador/Logistica/ControladorCalendario.php",
                    cache: false,
                    data: { vehiculo:vehiculo,horaInicio:horaInicio,horaFin:horaFin,albaran:albaran,fecha:fecha,accion:'addViaje' }
                }).done(function( respuesta ){

                   $("#respuesta_form").html(respuesta);

                    setTimeout(function(){
                            $("#respuesta_form").html("");
                        },2200);

                });

           });

            //MODIFICAR VIAJE
            $(document).on("click",'.editar_viaje',function(e){
                e.preventDefault();
                alert("hola");

                var id=$(this).attr("rel");
                alert(id);
                //var fecha=$("#fecha").val();

                $.ajax({
                    type: "POST",
                    url: "<?php echo parent::getUrlRaiz()?>/Vista/Logistica/GeneradorFormsViews.php",
                    cache: false,
                    data: { cod:2,id:id}
                }).done(function(respuesta2){

                    $("#respuesta_form").html(respuesta2)


                });
            });

            //GUARDAR PARTE MODIFICADO
            $(document).on("click",'.modificar',function(e){

                e.preventDefault(e);
                var id= $("#idViaje").val();
                var vehiculo= $("#Vehiculo").val();
                var horasInicio= $('#HorasInicio').val()+":"+$('#MinutosInicio').val()+":00";
                var horasFin= $('#HorasFin').val()+":"+$('#MinutosFin').val()+":00";
                var albaran= $("#Albaran").val();

                $.ajax({
                    type:"POST",
                    url:"<?php echo parent::getUrlRaiz()?>/Controlador/Logistica/ControladorCalendario.php",
                    cache:false,
                    data:{id:id,vehiculo:vehiculo,horasInicio:horasInicio,horasFin:horasFin,albaran:albaran,accion:"modificar_viaje"}
                }).done(function(respuesta){
                    $("#respuesta_form").html(respuesta);
                });
            });




            //eliminar viaje
            $(document).on("click",'.eliminar_evento',function (e)
            {
                e.preventDefault();

                var id=$(this).attr("rel");
                var confirmar = confirm("¿Estás seguro de querer borrar el viaje?");
                $.ajax({
                    type: "POST",
                    url: "<?php echo parent::getUrlRaiz()?>/Controlador/Logistica/ControladorCalendario.php",
                    cache: false,
                    data: { id:id,accion:"borrar_viaje" }
                }).done(function( respuesta2 )
                {
                    $('#respuesta_form').css("display","none");
                    $("#respuesta").html(respuesta2);
                    setTimeout(function(){

                        $("#mask").fadeOut(500);

                        location.reload();

                    },2000);
                });
            });

            $(document).on("click",".anterior,.siguiente,.hoyEnlace",function(e)
            {
                e.preventDefault();
                var datos=$(this).attr("rel");
                var nueva_fecha=datos.split("-");
                generar_calendario(nueva_fecha[1],nueva_fecha[0]);
            });

        });
    </script>

    <!-- ESTO NO TE HACE FALTA! -->
    <script type="text/javascript">
        var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
        document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
    </script>
    <script type="text/javascript">
        try {
            var pageTracker = _gat._getTracker("UA-266167-20");
            pageTracker._setDomainName(".martiniglesias.eu");
            pageTracker._trackPageview();
        } catch(err) {}</script>

<?php
require_once __DIR__."/../Plantilla/pie.php";
}
}

