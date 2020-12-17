<?php
require_once 'DataBase.php';
session_start();

if(isset($_SESSION['user'])){
}else{
    header('Location: index.php');
}

$c=$_SESSION['user'];

    $sql = "SELECT `RAZON_SOCIAL` FROM gendy.negocio WHERE `ID_NEGOCIO`=$c";
    $nombre_neg=$DB->prepare($sql);
    $nombre_neg->setFetchMode(PDO::FETCH_ASSOC);
    $nombre_neg->execute();

?>

<html>

    <head>
        <meta charset="utf-8">
        <title>Gendy | Menu Negocio</title>
        <link rel="stylesheet" href="css/menunegocio.css">
    </head>
    <body>

        
    <section id="principal">
            <div class="barralateral">
                <form action="">
                    <input class="Glogo" type="image" src="css/Imagenes/Nlogogendy.png" name='Glogo' onclick="" />
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
                    <img class="Logo" src="css/Imagenes/-_Gendy azul.png" />
                    <p>¡Hola! 

                    <?php
                        while ($nom = $nombre_neg->fetch()){
                            echo ($nom["RAZON_SOCIAL"]);
                        }                
                    ?>
                    
                    </p>
                    <p>¿En que te podemos ayudar?</p>
                    <br><br>
                    
                    <section id="principal">

                        <form action="calendario_negocio.php" >
                        <input class="boton_calendario" type="submit" value="Calendario de citas" name='Calendario de citas' onclick="" />
                        </form>

                        <p class="tab">

                        <form action="estadisticas_negocio.php" >
                        <input class="boton_estadisticas" type="submit" value="Estadisticas del negocio" name='Estadisticas del negocio' onclick="" />                        
                        </form>
                        </p>
                    </section>

                        <br><br>

                    <section id="principal">
                        <form action="ajustes_negocio_pre.php" >
                        <input class="boton_ajustes" type="submit" value="Ajustes del negocio" name='Ajustes del negocio' onclick="" />
                        </form>

                        <p class="tab">

                        <form action="servicios_negocio.php" >
                        <input class="boton_negocio_servicios" type="submit" value="Portafolio del negocio" name='Portafolio del negocio' onclick="" />                        
                        </form>
                        </p>
                    </section> 

                    </div>

        </section>           
    </body>
</html>