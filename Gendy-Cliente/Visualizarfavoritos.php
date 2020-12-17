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

$e=$_SESSION['user'];

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
                <form action="MenuCliente.php">
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
                        <h1>Tus negocios favoritos</h1>      
                        <div class="scrollfavoritosNeg">
                            <?php {
                                $sql = "SELECT * FROM gendy.negocios_favoritos JOIN gendy.negocio ON negocios_favoritos.ID_NEGOCIO = negocio.ID_NEGOCIO JOIN gendy.usuario ON usuario.ID_USUARIO = negocios_favoritos.ID_USUARIO WHERE usuario.ID_USUARIO =:favorito";
                                $datosFav = $DB->prepare($sql);
                                $datosFav->execute(array(':favorito' => $_SESSION['user']));

                                while ($dataFav = $datosFav->fetch()) {
                                    ?>
                                    <form action="VisualizarServicios.php" method="GET">
                                        <input class="BotonServicios" type="submit" value="<?php echo $dataFav["RAZON_SOCIAL"]; ?>" name='Nombre' onclick="" />
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

