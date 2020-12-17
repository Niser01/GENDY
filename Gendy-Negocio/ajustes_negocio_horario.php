<?php
session_start();
require_once 'DataBase.php';


if(isset($_SESSION['user'])){
}else{
    header('Location: ../index.php');
}

$c=$_SESSION['user'];


if(!empty($_POST['apertura'])){
    $sql = "UPDATE `negocio` SET `HORA_APERTURA` = :loc WHERE `negocio`.`ID_NEGOCIO`=$c";
    $lun=$DB->prepare($sql);
    $lun->setFetchMode(PDO::FETCH_ASSOC);
    $lun->execute(array(':loc' => $_POST['apertura']));
    header('Location: MenuNegocio.php');
}

if(!empty($_POST['cierre'])){
    $sql = "UPDATE `negocio` SET `HORA_CIERRE` = :loc WHERE `negocio`.`ID_NEGOCIO`=$c";
    $lun=$DB->prepare($sql);
    $lun->setFetchMode(PDO::FETCH_ASSOC);
    $lun->execute(array(':loc' => $_POST['cierre']));
    header('Location: MenuNegocio.php');
}    

if(!empty($_POST['dia_apertura'])){
    $sql = "UPDATE `negocio` SET `DIA_APERTURA` = :loc WHERE `negocio`.`ID_NEGOCIO`=$c";
    $lun=$DB->prepare($sql);
    $lun->setFetchMode(PDO::FETCH_ASSOC);
    $lun->execute(array(':loc' => $_POST['dia_apertura']));
    header('Location: MenuNegocio.php');
} 

if(!empty($_POST['dia_cierre'])){
    $sql = "UPDATE `negocio` SET `DIA_CIERRE` = :loc WHERE `negocio`.`ID_NEGOCIO`=$c";
    $lun=$DB->prepare($sql);
    $lun->setFetchMode(PDO::FETCH_ASSOC);
$lun->execute(array(':loc' => $_POST['dia_cierre']));
    header('Location: MenuNegocio.php');
} 

?>


<html>

    <head>
        <meta charset="utf-8">
        <title>Gendy | Ajustes Negocio</title>
        <link rel="stylesheet" href="css/ajustes.css">
    </head>
    <body>

    <section id="principal">
                <div class="barralateral">
                    <form action="MenuNegocio.php">
                        <input class="Glogo" type="image" src="css/Imagenes/Nlogogendy.png" name='Glogo' onclick="openForm()" />
                    </form>
                    <form action="ajustes_negocio_pre.php">
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


        <div class = "botones">
            <h1>Horario del negocio</h1>
            
            <p>Ingrese los valores que desea modificar. Puede dejar en blanco los datos que no va a modificar</p>
            <br>
            

                <form method="post">
                    <label>Hora de apertura: (Formato 24h)</label>
                    <input type="text" name="apertura">
                    <br>
                    <label>Hora de cierre: (Formato 24h)</label>
                    <input type="text" name="cierre">
                    <br>
                    <label>Día de apertura: (Ingrese el día de la semana)</label>
                    <input type="text" name="dia_apertura">
                    <br>
                    <label>Día de cierre: (Ingrese el día de la semana)</label>
                    <input type="text" name="dia_cierre">

                    <div class="BMod">
                        <input type="submit" value="Modificar" />
                    </div>


                </form>



            </div>
        </div>
            
        </section> 
    </body>
</html>