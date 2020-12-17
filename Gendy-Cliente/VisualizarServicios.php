<?php
session_start();
require_once 'DataBase.php';
if (isset($_SESSION["success"])) {
    //echo('<label style="color:green">' . $_SESSION["success"] . "</label>\n");
    $negocio = $_GET["Negocio"];
    $_SESSION['negocio'] = $negocio;
} else {
    header('Location: ../index.php');
}

$nombre_negocio=$_GET['Nombre'];
$_SESSION['nom_neg'] = $nombre_negocio;
$nombre="'".$nombre_negocio."'";

$SQLservicios = "SELECT * FROM `servicios` WHERE `ID_NEGOCIO` = (SELECT `ID_NEGOCIO` FROM `negocio` WHERE `RAZON_SOCIAL`= $nombre ORDER BY `ID_NEGOCIO` DESC LIMIT 1)";
$datos=$DB->prepare($SQLservicios);
$datos->setFetchMode(PDO::FETCH_ASSOC);
$datos->execute();

?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Gendy | Menu Cliente</title>
        <link rel="stylesheet" href="css/MenuCliente.css">
    </head>
    <body>
        <section id="principal">
            <div class="barralateral">
                <form action="VisualizarTodosNegocios.php">
                        <input class="ret" type="image" src="css/Imagenes/retorno_invertido.png" name='ret' onclick="" />
                </form>
                
                <form action="calendario_Cliente.php">
                    <input class="boton" type="image" src="css/Imagenes/Mesa de trabajo 5.png" name='Calendario' onclick="" />
                </form>

                <form action="">
                    <input class="boton" type="image" src="css/Imagenes/Mesa de trabajo 11.png" name='Crear' onclick="" />
                </form>
                <form action="PQR.php">
                    <input class="boton" type="image" src="css/Imagenes/Mesa de trabajo 4.png" name='PQR' onclick="" />
                </form>
                <form action="CerrarSesion.php" >
                    <input class="logout" type="image" src="css/Imagenes/logout_invertido.png" name='logoff' onclick="" />
                </form>
            </div>
                
            <div class="informacionUsuario">
                <img class="Logo" src="css/Imagenes/-_Gendy azul.png" alt="Gendy"/>
                <div class="informacionUsuario2">
                    <label class="texto">¡Hola! 
                        <?php
                        $sql = "SELECT * FROM gendy.usuario WHERE usuario.ID_USUARIO =:usuario";
                        $datosUser = $DB->prepare($sql);
                        $datosUser->execute(array(':usuario' => $_SESSION['user']));
                        while ($dataUser = $datosUser->fetch()) {
                            echo('<label class ="texto">' . $dataUser["NOMBRE_USUARIO"] . '</label>');
                        }
                        ?>
                    </label>
                </div>
            </div>

                

            <div class="Menuopciones">
                <div class="Menuopcionesabajo">                      
                    <div class="FavoritosNeg">
                    <h1><?php echo($nombre_negocio); ?>: </h1>  
                            <label class="texto">Selecciona el servicio que deseas reservar:    <br></label>
                            <div class="scrollfavoritosNeg">
                                <?php {
                                    while ($dataFav = $datos->fetch()) {
                                        ?>
                                        <form action="calendario_Cliente.php?" method="GET">
                                            <input class="BotonServicios" type="submit" value="<?php echo $dataFav["NOMBRE_SERVICIOS"]; ?>" name='Servicio' onclick="" />
                                        </form>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                </div>   
                
                
        </section>
    </body>
</html> 

