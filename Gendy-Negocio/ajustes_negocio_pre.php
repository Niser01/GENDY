<?php
session_start();

if(isset($_SESSION['user'])){
}else{
    header('Location: ../index.php');
}

?>

<html>

<head>
    <meta charset="utf-8">
    <title>Gendy | Ajustes Negocio</title>
    <link rel="stylesheet" href="css/ajustes_pre.css">
</head>
    <body>
        

        <section id="principal">
                <div class="barralateral">
                    <form action="MenuNegocio.php">
                        <input class="Glogo" type="image" src="css/Imagenes/Nlogogendy.png" name='Glogo' onclick="openForm()" />
                    </form>
                    <form action="MenuNegocio.php">
                        <input class="ret" type="image" src="css/Imagenes/retorno_invertido.png" name='ret' onclick="openForm()" />
                    </form>

                    <div class="abajo">
                        <form action="">
                            <input class="Flogo" type="image" src="css/Imagenes/f_logo.png" name='Flogo' onclick="openForm()" />
                        </form>
                        <form action="">
                            <input class="Ilogo" type="image" src="css/Imagenes/I_logo.png" name='Ilogo' onclick="openForm()" />
                        </form>
                        <form action="">
                            <input class="Tlogo" type="image" src="css/Imagenes/T_logo.png" name='Tlogo' onclick="openForm()" />
                        </form>
                        <form action="CerrarSesion.php" >
                            <input class="logout" type="image" src="css/Imagenes/logout_invertido.png" name='logoff' onclick="openForm()" />
                        </form>
                        <form action="">
                            <input class="falla" type="image" src=" "  />
                        </form>
                    </div>

                </div>

                <div class="botones">
                    <br>
                    <h1>Ajustes de negocio</h1>
                    <p>Selecciona la acción que desear realizar</p>
                    <br><br><br>
                
                    <section id="principal">
                    <form action="ajustes_negocio.php" >
                    <input class="boton_ajustes_negocio" type="submit" value="Información del negocio" name='Ajustes del negocio' onclick="" />
                    <br><br>
                    </form>
                    <div class="tab"></div>
                    <form action="ajustes_negocio_horario.php" >
                    <input class="boton_negocio_horario" type="submit" value="Horarios del negocio" name='Horarios del negocio' onclick="" />
                    <br><br>
                    </form>
                    </section>


                </div>

        </section> 

    </body>
</html>