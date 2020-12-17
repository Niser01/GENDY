<?php
session_start();
if (isset($_SESSION["success"])) {
} else {
    header('Location: ../index.php');
}


$e=$_SESSION['user'];

?> 
<html>
    <head>
        <meta charset="utf-8">
        <title>Gendy | Menu Cliente</title>
        <link rel="stylesheet" href="css/pqr.css">
    </head>
    <body>
        <section id="principal">
            <div class="barralateral">
                <form action="MenuCliente.php">
                        <input class="ret" type="image" src="css/Imagenes/retorno_invertido.png" name='ret' onclick="" />
                </form>
                <form action="calendario_Cliente.php">
                    <input class="boton" type="image" src="css/Imagenes/Mesa de trabajo 5.png" name='Calendario' onclick="" />
                </form>            
                <form action="CerrarSesion.php" >
                    <input class="logout" type="image" src="css/Imagenes/logout_invertido.png" name='logoff' onclick="" />
                </form>
            </div>




            <div class="pqr">
                <img class="Logo" src="css/Imagenes/-_Gendy azul.png" alt="Gendy"/>

                <br><br>

                <p>En esta sección encontrarás las preguntas más frecuentes respecto a la navegacion en nuestra aplicación.</p>
                <div class="preguntas">
                    <p>1. ¿Donde puedo observar mis citas programadas?</p>
                    <p>En el icono <img src="css/Imagenes/Mesa de trabajo 5.png" width="25" height="25"> se podra en contrar el calendario con sus citas programadas.</p>
                    <p>2. ¿Como cancelar mis citas?</p>
                    <p>Dentro del calendario, usted debe seleccionar la cita, presionar en "Modificar" y luego en "Eliminar".</p>
                    <p>3. ¿Porque no puedo ver los servicios de un negocio?</p>
                    <p>Esto es debido a que el negocio no ha cargado en nuestra plataforma los servicios que ofrece.</p>
                    <p>4. ¿Se pueden modificar las citas que ya estan programadas?</p>
                    <p>Dentro del calendario, usted debe seleccionar la cita, presionar en "Modificar" y luego introducir las nuevas fechas y horas que necesita.</p>
                </div>
                <br><br><br>
                <div class="copyright">
                <p>&copy; Gendy Inc</p>
                </div>
            </div>
          
                
        


        </section>


    </body>
</html> 