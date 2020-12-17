<?php
require_once '../DataBase.php';
session_start();

if(isset($_SESSION['user'])){
}else{
    header('Location: ../index.php');
}

$c=$_SESSION['user'];

$nombre=$_SESSION['nom_neg'];
$servico=$_GET['Servicio'];


    $sql = "SELECT `NOMBRE_USUARIO` FROM `usuario` WHERE `ID_USUARIO`=$c";
    $nombre_neg=$DB->prepare($sql);
    $nombre_neg->setFetchMode(PDO::FETCH_ASSOC);
    $nombre_neg->execute();


?>

<html>

    <head>
        <meta charset="utf-8">
        <title>Gendy | Calendario Cliente</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="js/moment.min.js"></script>

        <link rel="stylesheet" href="css/fullcalendar.min.css">
        <script src="js/fullcalendar.min.js"></script>
        <script src="js/es.js"></script>

        <link rel="stylesheet" href="css/calendario.css">

 
    </head>
    <body>
        
    <section id="principal">
            <div class="barralateral">
                <form action="MenuCliente.php">
                    <input class="Glogo" type="image" src="css/Imagenes/Nlogogendy.png" name='Glogo' onclick="" />
                </form>
                <form action="MenuCliente.php">
                        <input class="ret" type="image" src="css/Imagenes/retorno_invertido.png" name='ret' onclick="" />
                </form>

                <div class="abajo">

                    <form action="CerrarSesion.php" >
                        <input class="logout" type="image" src="css/Imagenes/logout_invertido.png" name='logoff' onclick="" />
                    </form>
                    <form action="">
                        <input class="falla" type="image" src=" "  />
                    </form>
                </div>

            </div>



            <div class="titulo">
                <h1>Calendario de 
                    <?php
                        while ($nom = $nombre_neg->fetch()){
                            echo ($nom["NOMBRE_USUARIO"]);
                        }                
                    ?>
                </h1>
                <p>Selecciona la fecha que deseas: </p>        
                <div class="container">
                    <div id="CalendarioWeb"></div>
                </div>
            </div>
            
        </section> 

            <script>
                $(document).ready(function(){
                    $('#CalendarioWeb').fullCalendar({

                        header:{
                            left:'prev,next',
                            center:'title',
                            right: 'month,agendaWeek,agendaDay,today'
                        },
                        dayClick:function(date,jsEvent,view){
                            var nombre=("<?php echo($nombre); ?>");
                            var servicio=("<?php echo($servico); ?>");
                            var fecha1 = date;
                            var fecha2 = date.format();


                            $("#negocio").val(nombre); 
                            $("#Servicio_selec").val(servicio); 
                            $("#fechainicio").val(fecha2); 
                            $("#fechafin").val(fecha2);
                            $("#dia").val(fecha1);

                            $("#Programar").modal("show");                         
                        },


                        events:'http://localhost/Gendy/Gendy-Cliente/calendario_busqueda.php',

                        eventClick:function(calEvent,jsEvent,view){ 
                            $("#nombre").html(calEvent.nombre_negocio);                          
                            $("#id_cita").html(calEvent.id_cita);
                            id_C = calEvent.id_cita;
                            $("#nombre_usuario").html(calEvent.nombre_negocio);
                            nombreU = calEvent.nombre_negocio;
                            $("#Tel_usuario").html(calEvent.telefono_negocio);
                            telU = calEvent.telefono_negocio;
                            $("#Serv_selec").html(calEvent.nombre_servicio);
                            servicioU = calEvent.descripcion_servicio;
                            $("#descripcion").html(calEvent.descripcion_servicio);
                            descripU = calEvent.descripcion_servicio;
                            $("#precio").html(calEvent.precio_servicio);   
                            prec = calEvent.precio_servicio; 
                                 
                            FechaHora1 = calEvent.start._i.split(" ");
                            $("#startfecha").val(FechaHora1[0]);
                            $("#starthora").val(FechaHora1[1]);
                            FechaHora2 = calEvent.end._i.split(" ");
                            $("#endfecha").val(FechaHora2[0]);
                            $("#endhora").val(FechaHora2[1]); 
                                  
                            $("#citasprogramadas").modal("show"); 
                        }
                    });
                

                    function RecolectarDatosGUI(){
                        NuevoEvento={
                            id_Cita: id_C,
                            nombre: nombreU,
                            telefono: telU,
                            servicio: servicioU, 
                            descripcion: descripU,
                            precio: prec,
                            start:$("#startfecha").val()+" "+$("#starthora").val(),
                            end:$("#endfecha").val()+" "+$("#endhora").val()
                        };                    
                    }

                    function RecolectarEnvioDatosGUI(){
                        NuevoEvento={                            
                            nombre: $("#negocio").val(),                        
                            servicio: $("#Servicio_selec").val(), 
                            start:$("#fechainicio").val()+" "+$("#horainicio").val(),
                            end:$("#fechafin").val()+" "+$("#horafin").val(),
                            dia:$("#dia").val()
                        };                    
                    }



                    $("#botonEliminar").click(function(){
                        RecolectarDatosGUI();
                        EnviarInfo("eliminar", NuevoEvento);
                    });

                    
                    $("#botonModificar").click(function(){
                        RecolectarDatosGUI();
                        EnviarInfo("modificar", NuevoEvento);
                    });

                    $("#botonEnviar").click(function(){
                        RecolectarEnvioDatosGUI();
                        EnviarInfoagregar("agregar", NuevoEvento);
                    });

                    function EnviarInfo(accion, objEvento){
                        $.ajax({
                            url:'calendario_busqueda.php?accion='+accion,
                            type:'POST',                        
                            data: objEvento,

                            success:function(ec){
                                if(ec){
                                    
                                    $("#citasprogramadas").modal("toggle"); 
                                    $("#modificarEcitas").modal("toggle"); 
                                    $('#CalendarioWeb').fullCalendar('refetchEvents');

                                }

                            }

                        })
                        
                    }
                    
                    function EnviarInfoagregar(accion, objEvento){
                        $.ajax({
                            url:'calendario_busqueda.php?accion='+accion,
                            type:'POST',                        
                            data: objEvento,

                            success:function(ec){
                                if(ec){
                                    
                                    $("#citasprogramadas").modal("toggle"); 
                                    $("#modificarEcitas").modal("toggle"); 
                                    $("#Programar").modal("toggle"); 
                                    $('#CalendarioWeb').fullCalendar('refetchEvents');
                                    $("#citasprogramadas").modal("toggle"); 
                                    $("#modificarEcitas").modal("toggle"); 
                                    
                                }

                            }

                        })
                        
                    }

                });
            </script>


<div class ="prueba">

<!--*********************************************************************************************************************************** -->
<!--Codigo para ventana modal con cita -->

        <div class="modal fade" id="citasprogramadas" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <h3 id="descripcionEvento">Cita con: </h3><h3 id="nombre">ed</h3>

                    </div>
                    <div class="modal-body">
                        <div id="descripcionEvento">Id cita:  </div><div id="id_cita"></div>
                        <div id="descripcionEvento">Nombre del negocio: </div><div id="nombre_usuario">ed</div>
                        <div id="descripcionEvento">Telefono del negocio: </div><div id="Tel_usuario">ed</div>
                        <br>
                        <div id="descripcionEvento">Servicio seleccionado: </div><div id="Serv_selec">ed</div>
                        <div id="descripcionEvento">Descripcion del servicio seleccionado: </div><div id="descripcion">ed</div>
                        <div id="descripcionEvento">Precio del servicio seleccionado: </div><div id="precio">ed</div>

                    </div>
                    <div class="modal-footer">
                    
                        <button type="button" class="btn btn-success"  data-toggle="modal" href="#modificarEcitas">Modificar</button>                    
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    
                    </div>
                </div>
            </div>
        </div>

        <!--Codigo para modificar cita -->

        <div class="modal fade" id="modificarEcitas" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <h3 id="descripcionEvento">Actualización de citas: </h3>

                    </div>
                    <div class="modal-body">
                    
                        Hora de inicio (Formato 24h): <input type="text" id="starthora" /><br/><br>
                        Fecha de incio:<input type="text" id="startfecha"/><br/><br>
                        Hora de terminación (Formato 24h): <input type="text" id="endhora" /><br/><br/>
                        Fecha de terminación: <input type="text" id="endfecha"/><br/>                                             

                    </div>

                    <div class="modal-footer">                        
                        <button type="button" id="botonModificar" class="btn btn-success">Modificar</button>
                        <button type="button" class="btn btn-warning" id="botonEliminar">Eliminar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    
                    </div>
                </div>
            </div>
        </div>


        <!--Codigo para ventana modal sin cita -->

        <div class="modal fade" id="Programar" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 id="sinProgramar_descripcionEvento">Agendar cita</h3>
                    </div>

                    <div class="modal-body">
                        

                        Nombre del negocio: <input type="text" id="negocio" /><br/><br>
                        Servicio seleccionado: <input type="text" id="Servicio_selec" /><br/><br>
                        Hora de inicio (Formato 24h): <input type="text" id="horainicio" /><br/><br>
                        Fecha de incio: <input type="text" id="fechainicio"/><br/><br>
                        Hora de terminación (Formato 24h): <input type="text" id="horafin" /><br/><br/>
                        Fecha de terminación: <input type="text" id="fechafin"/><br/>
                        <input type="text" class="dia" id="dia"/><br/>
                        

                    </div>

                    <div class="modal-footer">
                    <button type="button" id="botonEnviar" class="btn btn-success">Agregar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>                
                    </div>
                </div>
            </div>
        </div>
<!--*********************************************************************************************************************************** -->   

</div>       

    </body>
</html>

