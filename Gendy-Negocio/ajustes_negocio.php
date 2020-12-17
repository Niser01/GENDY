<?php
session_start();
require_once 'DataBase.php';


if(isset($_SESSION['user'])){
}else{
    header('Location: ../index.php');
}


$c=$_SESSION['user'];

if(!empty($_POST['razon'])){
    $sql = "UPDATE `negocio` SET `RAZON_SOCIAL` = :razon WHERE `negocio`.`ID_NEGOCIO`=$c";
    $lun=$DB->prepare($sql);
    $lun->setFetchMode(PDO::FETCH_ASSOC);
    $lun->execute(array(':razon' => $_POST['razon']));
    header('Location: MenuNegocio.php');
}

if(!empty($_POST['correo'])){
    $sql = "UPDATE `negocio` SET `CORREO_ELECTRONICO_NEGOCIO` = :correo WHERE `negocio`.`ID_NEGOCIO`=$c";
    $lun=$DB->prepare($sql);
    $lun->setFetchMode(PDO::FETCH_ASSOC);
    $lun->execute(array(':correo' => $_POST['correo']));
    header('Location: MenuNegocio.php');
}

if(!empty($_POST['contrasena'])){
    $sql = "UPDATE `negocio` SET `CONTRASENA_NEGOCIO` = :contra WHERE `negocio`.`ID_NEGOCIO`=$c";
    $lun=$DB->prepare($sql);
    $lun->setFetchMode(PDO::FETCH_ASSOC);
    $lun->execute(array(':contra' => $_POST['contrasena']));
    header('Location: MenuNegocio.php');
}

if(!empty($_POST['telefono'])){
    $sql = "UPDATE `negocio` SET `TELEFONO_NEGOCIA` = :tel WHERE `negocio`.`ID_NEGOCIO`=$c";
    $lun=$DB->prepare($sql);
    $lun->setFetchMode(PDO::FETCH_ASSOC);
    $lun->execute(array(':tel' => $_POST['telefono']));
    header('Location: MenuNegocio.php');
}

if(!empty($_POST['direccion'])){
    $sql = "UPDATE `negocio` SET `DIRECCION_NEGOCIO` = :dir WHERE `negocio`.`ID_NEGOCIO`=$c";
    $lun=$DB->prepare($sql);
    $lun->setFetchMode(PDO::FETCH_ASSOC);
    $lun->execute(array(':dir' => $_POST['direccion']));
    header('Location: MenuNegocio.php');
}

if(!empty($_POST['localidad'])){
    $sql = "UPDATE `negocio` SET `LOCALIDAD` = :loc WHERE `negocio`.`ID_NEGOCIO`=$c";
    $lun=$DB->prepare($sql);
    $lun->setFetchMode(PDO::FETCH_ASSOC);
    $lun->execute(array(':loc' => $_POST['localidad']));
    header('Location: MenuNegocio.php');
}

if(!empty($_POST['aforo'])){
    $sql = "UPDATE `negocio` SET `AFORO` = :loc WHERE `negocio`.`ID_NEGOCIO`=$c";
    $lun=$DB->prepare($sql);
    $lun->setFetchMode(PDO::FETCH_ASSOC);
    $lun->execute(array(':loc' => $_POST['aforo']));
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

            <div class="botones">
                <h1>Ajustes del negocio</h1>
                <p>Ingrese los valores que desea modificar. Puede dejar en blanco los datos que no va a modificar</p>

                    <form method="post">
                        <label>Razon Social:</label>
                        <input type="text" name="razon">  
                        <label>Correo Electronico:</label>
                        <input type="email" name="correo">
                        <label>Contraseña:</label>
                        <input type="password" name="contrasena">
                        <label>Telefono:</label>
                        <input type="text" name="telefono">
                        <label>Direccion:</label>
                        <input type="text" name="direccion">
                        <label>Localidad:</label>
                        <input type="text" name="localidad">
                        <label>Aforo permitido:</label>
                        <input type="text" name="aforo">
                        
                        <div class="BMod">
                        <input type="submit" value="Modificar" />
                        </div>

                    </form>


            </div>
            
        </section> 
    </body>
</html>